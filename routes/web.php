<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\AuditLog;

Route::get('/', [PostController::class, 'publicIndex'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Manajemen user (hanya admin)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update'])
            ->middleware('audit_log:user_management');
    });

    Route::middleware(['role:admin,editor,author'])->group(function () {
        // CRUD posts – log aktivitas
        Route::resource('posts', PostController::class)
            ->except(['show'])
            ->middleware('audit_log:post_crud');

        Route::post('/posts/{post}/submit', [PostController::class, 'submitForReview'])
            ->name('posts.submit')
            ->middleware(['role:author', 'audit_log:post_submit']);

        Route::post('/posts/{post}/approve', [PostController::class, 'approve'])
            ->name('posts.approve')
            ->middleware(['role:editor,admin', 'audit_log:post_approve']);

        Route::post('/posts/{post}/reject', [PostController::class, 'reject'])
            ->name('posts.reject')
            ->middleware(['role:editor,admin', 'audit_log:post_reject']);

        Route::get('/audit-logs', function () {
            $logs = AuditLog::with('user')->latest()->paginate(20);

            return view('audit_logs.index', compact('logs'));
        })->name('audit-logs.index');
    });
});

// TIDAK ada "require __DIR__.'/auth.php';" di sini