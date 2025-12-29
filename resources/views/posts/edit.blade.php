{{-- resources/views/posts/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <p class="text-sm text-gray-600 mb-4">
                Status: <strong>{{ ucfirst(str_replace('_', ' ', $post->status)) }}</strong>
            </p>

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

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc ml-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Judul
                        </label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $post->title) }}"
                               class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">
                            Konten
                        </label>
                        <textarea name="body" id="body" rows="8"
                                  class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('posts.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Kembali
                        </a>

                        <div class="flex gap-2">
                            {{-- Workflow actions --}}
                            @if(auth()->user()->hasRole('author') && auth()->id() === $post->user_id)
                                @if(in_array($post->status, ['draft', 'rejected']))
                                    <form action="{{ route('posts.submit', $post) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="px-3 py-2 bg-yellow-100 text-yellow-800 rounded text-sm">
                                            Submit Review
                                        </button>
                                    </form>
                                @endif
                            @endif

                            @if(auth()->user()->hasRole(['editor','admin']) && $post->status === 'pending_review')
                                <form action="{{ route('posts.approve', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="px-3 py-2 bg-green-100 text-green-800 rounded text-sm">
                                        Approve & Publish
                                    </button>
                                </form>

                                <form action="{{ route('posts.reject', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="px-3 py-2 bg-red-100 text-red-800 rounded text-sm">
                                        Reject
                                    </button>
                                </form>
                            @endif

                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>