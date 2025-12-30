{{-- resources/views/dashboard.blade.php --}}
@php
use App\Models\Post;

$user = auth()->user();
$roles = $user?->roles->pluck('name')->toArray() ?? [];

// Statistik hanya untuk admin & editor
$showPostStats = in_array('admin', $roles) || in_array('editor', $roles);

if ($showPostStats) {
$totalPosts = Post::count();
$publishedPosts = Post::where('status', 'published')->count();
$pendingPosts = Post::where('status', 'pending_review')->count();
$draftPosts = Post::where('status', 'draft')->count();
}
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profil singkat + badge role --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-2">
                    <p class="text-lg">
                        Halo, <span class="font-semibold">{{ $user->name }}</span>
                    </p>

                    <p class="text-sm text-gray-600">
                        Email: {{ $user->email }}
                    </p>

                    <p class="text-sm text-gray-600 flex items-center gap-2">
                        Role:
                        @if(in_array('admin', $roles))
                        <span class="px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-700 border border-red-200">
                            Admin
                        </span>
                        @endif
                        @if(in_array('editor', $roles))
                        <span class="px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-700 border border-blue-200">
                            Editor
                        </span>
                        @endif
                        @if(in_array('author', $roles))
                        <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700 border border-green-200">
                            Author
                        </span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Statistik postingan (hanya admin & editor) --}}
            @if($showPostStats)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs uppercase text-gray-500 mb-1">Total Post</p>
                    <p class="text-2xl font-semibold text-gray-800">{{ $totalPosts }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs uppercase text-gray-500 mb-1">Published</p>
                    <p class="text-2xl font-semibold text-green-600">{{ $publishedPosts }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs uppercase text-gray-500 mb-1">Pending Review</p>
                    <p class="text-2xl font-semibold text-yellow-600">{{ $pendingPosts }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <p class="text-xs uppercase text-gray-500 mb-1">Draft</p>
                    <p class="text-2xl font-semibold text-gray-700">{{ $draftPosts }}</p>
                </div>
            </div>
            @endif

            {{-- Info per role --}}
            @if(in_array('author', $roles))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="font-semibold mb-1">Info untuk Author</p>
                    <p class="text-sm text-gray-600">
                        Anda dapat membuat dan mengelola postingan milik sendiri, lalu mengajukan review
                        ke Editor/Admin sebelum dipublikasikan.
                    </p>
                </div>
            </div>
            @endif

            @if(in_array('editor', $roles))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="font-semibold mb-1">Info untuk Editor</p>
                    <p class="text-sm text-gray-600">
                        Anda dapat meninjau postingan yang diajukan oleh Author dan memutuskan untuk
                        approve (publish) atau reject.
                    </p>
                </div>
            </div>
            @endif

            @if(in_array('admin', $roles))
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="font-semibold mb-1">Info untuk Admin</p>
                    <p class="text-sm text-gray-600">
                        Anda memiliki akses penuh untuk mengelola postingan, pengguna, dan audit log.
                    </p>
                </div>
            </div>
            @endif

            <a href="{{ route('profile.edit') }}" class="text-blue-600 underline">
                TEST: ke halaman profile
            </a>

        </div>
    </div>
</x-app-layout>