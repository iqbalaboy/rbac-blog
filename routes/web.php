<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'publicIndex'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Hanya user dengan role admin, editor, author yang boleh akses CRUD post
    Route::middleware(['role:admin,editor,author'])->group(function () {
        Route::resource('posts', PostController::class)->except(['show']);

        Route::post('/posts/{post}/submit', [PostController::class, 'submitForReview'])
            ->name('posts.submit')
            ->middleware('role:author');

        Route::post('/posts/{post}/approve', [PostController::class, 'approve'])
            ->name('posts.approve')
            ->middleware('role:editor,admin');

        Route::post('/posts/{post}/reject', [PostController::class, 'reject'])
            ->name('posts.reject')
            ->middleware('role:editor,admin');
    });
});

require __DIR__ . '/auth.php';