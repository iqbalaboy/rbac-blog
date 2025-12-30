{{-- resources/views/posts/public_index.blade.php --}}
@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-widest text-blue-500 font-semibold">
                    Blog
                </p>
                <h2 class="mt-1 font-bold text-2xl text-gray-900 leading-tight">
                    Artikel Terbaru
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if($posts->count())
            <div class="space-y-6">
                @foreach($posts as $post)
                <article
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-md transition-shadow duration-150">
                    <h2 class="text-xl font-semibold">
                        <a href="{{ route('post.show', $post->slug) }}"
                            class="text-gray-900 hover:text-blue-600 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        By
                        <span class="font-medium text-gray-700">
                            {{ $post->author->name ?? 'Unknown' }}
                        </span>

                        @if($post->published_at)
                        · <span>
                            {{ $post->published_at->format('d M Y, H:i') }}
                        </span>
                        @endif
                    </p>

                    <p class="mt-3 text-sm text-gray-700">
                        {{ Str::limit(strip_tags($post->body), 200) }}
                    </p>

                    <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                        <a href="{{ route('post.show', $post->slug) }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 hover:underline font-medium">
                            Baca selengkapnya
                            <svg class="ms-1 h-3 w-3" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l3 3a1 1 0
                                              010 1.414l-3 3a1 1 0 01-1.414-1.414L13.586 10H4a1 1 0
                                              110-2h9.586l-1.293-1.293a1 1 0
                                              010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>

                        <span class="px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                            Published
                        </span>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
            @else
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                <p class="font-medium mb-1">Belum ada artikel.</p>
                <p class="text-sm">
                    Artikel yang sudah dipublish akan tampil di sini.
                </p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>