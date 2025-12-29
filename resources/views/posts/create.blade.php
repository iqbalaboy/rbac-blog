{{-- resources/views/posts/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Judul
                        </label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title') }}"
                               class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-gray-700">
                            Konten
                        </label>
                        <textarea name="body" id="body" rows="8"
                                  class="mt-1 block w-full border-gray-300 rounded shadow-sm">{{ old('body') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('posts.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan sebagai Draft
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>