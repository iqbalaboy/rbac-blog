<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @php
    $user = auth()->user();
    $roles = $user?->roles->pluck('name')->toArray() ?? [];
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-2">
                    <p class="text-lg">
                        Halo, <span class="font-semibold">{{ $user->name }}</span> 👋
                    </p>
                    <p class="text-sm text-gray-600">
                        Email: {{ $user->email }}
                    </p>
                    <p class="text-sm text-gray-600">
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
                        Anda memiliki akses penuh untuk mengelola postingan dan peran pengguna.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>