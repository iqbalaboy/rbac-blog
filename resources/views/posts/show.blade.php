{{-- resources/views/posts/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <p class="text-xs uppercase tracking-widest text-blue-500 font-semibold">
                Artikel
            </p>
            <h1 class="mt-1 font-bold text-2xl md:text-3xl text-gray-900 leading-tight">
                {{ $post->title }}
            </h1>
            <p class="mt-2 text-xs md:text-sm text-gray-500">
                By
                <span class="font-medium text-gray-700">
                    {{ $post->author->name ?? 'Unknown' }}
                </span>
                @if($post->published_at)
                · {{ $post->published_at->format('d M Y, H:i') }}
                @endif
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded text-sm">
                {{ session('error') }}
            </div>
            @endif

            <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="leading-relaxed text-gray-800 whitespace-pre-line">
                    {{ $post->body }}
                </div>
            </article>

            <div class="mt-4 flex items-center justify-between text-sm">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center text-blue-600 hover:text-blue-700 hover:underline">
                    <svg class="me-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0
                              010-1.414l4-4a1 1 0 111.414 1.414L5.414 9H17a1 1 0
                              110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Kembali ke daftar blog
                </a>

                <span class="text-xs text-gray-400">
                    ID: {{ $post->id }}
                </span>
            </div>
        </div>
    </div>
</x-app-layout>