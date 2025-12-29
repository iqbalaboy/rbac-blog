{{-- resources/views/posts/public_index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if($posts->count())
                <div class="space-y-6">
                    @foreach($posts as $post)
                        <article class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <h2 class="text-xl font-semibold">
                                <a href="{{ route('post.show', $post->slug) }}" class="text-blue-600 hover:underline">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-sm text-gray-500">
                                By {{ $post->author->name ?? 'Unknown' }}
                                @if($post->published_at)
                                    · {{ $post->published_at->format('d M Y H:i') }}
                                @endif
                            </p>
                            <p class="mt-2 text-gray-700">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->body), 150) }}
                            </p>
                        </article>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            @else
                <p>Belum ada artikel.</p>
            @endif
        </div>
    </div>
</x-app-layout>