{{-- resources/views/posts/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Post
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Manajemen Post</h1>

            <a href="{{ route('posts.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Post
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if($posts->count())
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-3 py-2 border">Judul</th>
                        <th class="px-3 py-2 border">Author</th>
                        <th class="px-3 py-2 border">Status</th>
                        <th class="px-3 py-2 border">Updated</th>
                        <th class="px-3 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="px-3 py-2 border">
                                {{ $post->title }}
                            </td>
                            <td class="px-3 py-2 border">
                                {{ $post->author->name ?? '-' }}
                            </td>
                            <td class="px-3 py-2 border">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($post->status === 'draft') bg-gray-100 text-gray-800
                                    @elseif($post->status === 'pending_review') bg-yellow-100 text-yellow-800
                                    @elseif($post->status === 'published') bg-green-100 text-green-800
                                    @elseif($post->status === 'rejected') bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                                </span>
                            </td>
                            <td class="px-3 py-2 border text-sm text-gray-600">
                                {{ $post->updated_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="px-3 py-2 border text-sm">
                                <div class="flex flex-wrap gap-2">
                                    @if($post->status === 'published')
                                        <a href="{{ route('post.show', $post->slug) }}"
                                           class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs">
                                            Lihat
                                        </a>
                                    @endif

                                    <a href="{{ route('posts.edit', $post) }}"
                                       class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                        Edit
                                    </a>

                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus post ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">
                                            Hapus
                                        </button>
                                    </form>

                                    {{-- Tombol workflow --}}
                                    @if(auth()->user()->hasRole('author') && auth()->id() === $post->user_id)
                                        @if(in_array($post->status, ['draft', 'rejected']))
                                            <form action="{{ route('posts.submit', $post) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">
                                                    Submit Review
                                                </button>
                                            </form>
                                        @endif
                                    @endif

                                    @if(auth()->user()->hasRole(['editor','admin']) && $post->status === 'pending_review')
                                        <form action="{{ route('posts.approve', $post) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('posts.reject', $post) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">
                                                Reject
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <p>Belum ada post.</p>
        @endif
    </div>
</x-app-layout>