{{-- resources/views/posts/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-2">
                    {{ $post->title }}
                </h1>

                <p class="text-sm text-gray-500 mb-4">
                    By {{ $post->author->name ?? 'Unknown' }}
                    @if($post->published_at)
                        · {{ $post->published_at->format('d M Y H:i') }}
                    @endif
                </p>

                <div class="prose max-w-none">
                    {!! nl2br(e($post->body)) !!}
                </div>
            </article>

            <div class="mt-4">
                <a href="{{ route('home') }}"
                   class="text-blue-600 hover:underline text-sm">
                    ← Kembali ke daftar blog
                </a>
            </div>
        </div>
    </div>
</x-app-layout>