<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as RequestFacade;

class PostController extends Controller
{
    // HALAMAN PUBLIK – LIST POST PUBLISHED
    public function publicIndex()
    {
        $posts = Post::where('status', 'published')
            ->latest('published_at')
            ->paginate(10);

        return view('posts.public_index', compact('posts'));
    }

    // HALAMAN PUBLIK – DETAIL POST PUBLISHED
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('posts.show', compact('post'));
    }

    // DASHBOARD – LIST POST (TERGANTUNG ROLE)
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('author') && !$user->hasRole(['admin', 'editor'])) {
            $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        } else {
            $posts = Post::latest()->paginate(10);
        }

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'body'    => $request->body,
            'status'  => 'draft',
        ]);

        // AUDIT LOG: create draft
        $this->logAudit(
            'post.created',
            "Membuat post '{$post->title}' (ID: {$post->id}) sebagai draft",
            $post
        );

        return redirect()
            ->route('posts.edit', $post)
            ->with('success', 'Post created as draft.');
    }

    public function edit(Post $post)
{
    /** @var User $user */
    $user = Auth::user();

    if ($user->hasRole('author') && !$user->hasRole(['admin', 'editor'])) {
        if ($post->user_id !== $user->id) {
            abort(403);
        }
    }

    return view('posts.edit', compact('post'));
}

    public function update(Request $request, Post $post)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('author') && !$user->hasRole(['admin', 'editor'])) {
            if ($post->user_id !== $user->id) {
                abort(403);
            }
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string'],
        ]);

        $post->update([
            'title' => $request->title,
            'body'  => $request->body,
        ]);

        // AUDIT LOG: update
        $this->logAudit(
            'post.updated',
            "Mengupdate post '{$post->title}' (ID: {$post->id})",
            $post
        );

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        /** @var User $user */
        $user = Auth::user();

        // author hanya boleh hapus miliknya & bukan published
        if ($user->hasRole('author') && !$user->hasRole(['admin', 'editor'])) {
            if ($post->user_id !== $user->id || $post->status === 'published') {
                abort(403);
            }
        }

        $title = $post->title;
        $id    = $post->id;

        $post->delete();

        // AUDIT LOG: delete
        $this->logAudit(
            'post.deleted',
            "Menghapus post '{$title}' (ID: {$id})"
        );

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted.');
    }

    // AUTHOR SUBMIT POST KE REVIEW
    public function submitForReview(Post $post)
    {
        $user = Auth::user();

        if ($post->user_id !== $user->id) {
            abort(403);
        }

        if (!in_array($post->status, ['draft', 'rejected'])) {
            return back()->with('error', 'Only draft or rejected posts can be submitted.');
        }

        $post->update([
            'status' => 'pending_review',
        ]);

        // AUDIT LOG: submit for review
        $this->logAudit(
            'post.submitted_for_review',
            "Author mengajukan review untuk post '{$post->title}' (ID: {$post->id})",
            $post
        );

        return back()->with('success', 'Post submitted for review.');
    }

    // EDITOR/ADMIN APPROVE
    public function approve(Post $post)
    {
        if ($post->status !== 'pending_review') {
            return back()->with('error', 'Only posts pending review can be approved.');
        }

        $post->update([
            'status'       => 'published',
            'published_at' => now(),
        ]);

        // AUDIT LOG: approve
        $this->logAudit(
            'post.approved',
            "Post '{$post->title}' (ID: {$post->id}) disetujui dan dipublish",
            $post
        );

        return back()->with('success', 'Post approved and published.');
    }

    // EDITOR/ADMIN REJECT
    public function reject(Post $post)
    {
        if ($post->status !== 'pending_review') {
            return back()->with('error', 'Only posts pending review can be rejected.');
        }

        $post->update([
            'status' => 'rejected',
        ]);

        // AUDIT LOG: reject
        $this->logAudit(
            'post.rejected',
            "Post '{$post->title}' (ID: {$post->id}) ditolak",
            $post
        );

        return back()->with('success', 'Post rejected.');
    }

    /**
     * Helper untuk mencatat audit log.
     */
    private function logAudit(string $action, string $description, $subject = null): void
    {
        AuditLog::create([
            'user_id'      => Auth::id(),
            'action'       => $action,
            'description'  => $description,
            'subject_type' => $subject ? get_class($subject) : null,
            'subject_id'   => $subject?->id,
            'ip_address'   => RequestFacade::ip(),
        ]);
    }
}
