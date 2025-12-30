{{-- resources/views/posts/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Post
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Daftar Post</h1>
                            <p class="mt-1 text-sm text-gray-600">
                                Kelola seluruh post yang Anda miliki
                            </p>
                        </div>
                        <a href="{{ route('posts.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow transition">
                            + Buat Post Baru
                        </a>
                    </div>
                </div>

                {{-- Alert --}}
                <div class="px-6 pt-4">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                            <p class="text-green-700 text-sm font-medium">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                            <p class="text-red-700 text-sm font-medium">
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-6">
                    @if($posts->count())
                        <div class="overflow-x-auto">
                            <table class="w-full table-fixed border border-gray-200 rounded-lg text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="w-3/12 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Judul
                                        </th>
                                        <th class="w-2/12 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Author
                                        </th>
                                        <th class="w-2/12 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Status
                                        </th>
                                        <th class="w-2/12 px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Update
                                        </th>
                                        <th class="w-3/12 px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($posts as $post)
                                        @php
                                            $statusClasses = match($post->status) {
                                                'draft' => 'bg-gray-100 text-gray-700',
                                                'pending_review' => 'bg-yellow-100 text-yellow-700',
                                                'published' => 'bg-green-100 text-green-700',
                                                'rejected' => 'bg-red-100 text-red-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp

                                        <tr class="hover:bg-gray-50 transition">
                                            {{-- Judul --}}
                                            <td class="px-4 py-4 align-top">
                                                <div class="font-medium text-gray-900 truncate">
                                                    {{ Str::limit($post->title, 50) }}
                                                </div>
                                                <div class="text-xs text-gray-500 truncate">
                                                    {{ $post->slug }}
                                                </div>
                                            </td>

                                            {{-- Author --}}
                                            <td class="px-4 py-4 text-gray-700 align-top">
                                                {{ $post->author->name ?? '-' }}
                                            </td>

                                            {{-- Status --}}
                                            <td class="px-4 py-4 align-top">
                                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                                    {{ ucfirst(str_replace('_', ' ', $post->status)) }}
                                                </span>
                                            </td>

                                            {{-- Updated --}}
                                            <td class="px-4 py-4 text-xs text-gray-500 align-top">
                                                {{ $post->updated_at->format('d M Y') }}<br>
                                                {{ $post->updated_at->format('H:i') }}
                                            </td>

                                            {{-- Actions --}}
                                            <td class="px-4 py-4 align-top">
                                                <div class="flex justify-center flex-wrap gap-2">

                                                    {{-- View --}}
                                                    @if($post->status === 'published')
                                                        <a href="{{ route('post.show', $post->slug) }}"
                                                           class="p-2 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800"
                                                           title="Lihat Post">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                            </svg>
                                                        </a>
                                                    @endif

                                                    {{-- Edit --}}
                                                    <a href="{{ route('posts.edit', $post) }}"
                                                       class="p-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200"
                                                       title="Edit Post">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>

                                                    {{-- Delete --}}
                                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                                          onsubmit="return confirm('Yakin hapus post ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="p-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200"
                                                                title="Hapus Post">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    {{-- Author Workflow --}}
                                                    @if(auth()->user()->hasRole('author') && auth()->id() === $post->user_id)
                                                        @if(in_array($post->status, ['draft', 'rejected']))
                                                            <form action="{{ route('posts.submit', $post) }}" method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="px-3 py-1 text-xs rounded-md bg-yellow-100 text-yellow-700 hover:bg-yellow-200">
                                                                    Submit
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endif

                                                    {{-- Editor/Admin Workflow --}}
                                                    @if(auth()->user()->hasRole(['editor','admin']) && $post->status === 'pending_review')
                                                        <form action="{{ route('posts.approve', $post) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="px-3 py-1 text-xs rounded-md bg-green-100 text-green-700 hover:bg-green-200">
                                                                Approve
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('posts.reject', $post) }}" method="POST">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="px-3 py-1 text-xs rounded-md bg-red-100 text-red-700 hover:bg-red-200">
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
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12 text-gray-500">
                            <p class="text-lg font-medium">Belum ada post</p>
                            <p class="text-sm mt-1">Silakan buat post baru untuk memulai.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
