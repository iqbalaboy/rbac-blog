{{-- resources/views/users/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

                {{-- Header --}}
                <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
                    <h1 class="text-2xl font-bold text-gray-900">Daftar User</h1>
                    <p class="text-sm text-gray-600 mt-1">
                        Kelola akun pengguna dan peran sistem secara interaktif
                    </p>
                </div>

                {{-- Alert --}}
                <div class="px-6 pt-4">
                    @if(session('success'))
                        <div class="mb-4 flex items-center gap-2 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 flex items-center gap-2 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>

                {{-- Table --}}
                <div class="p-6">
                    @if($users->count())
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full table-fixed text-sm">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="w-3/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Nama
                                        </th>
                                        <th class="w-4/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Email
                                        </th>
                                        <th class="w-3/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                            Role
                                        </th>
                                        <th class="w-2/12 px-5 py-3 text-center text-xs font-semibold text-gray-600 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($users as $user)
                                        <tr class="group hover:bg-blue-50/40 transition duration-200">
                                            {{-- Nama --}}
                                            <td class="px-5 py-4 font-semibold text-gray-900 truncate">
                                                {{ $user->name }}
                                            </td>

                                            {{-- Email --}}
                                            <td class="px-5 py-4 text-gray-700 truncate">
                                                {{ $user->email }}
                                            </td>

                                            {{-- Role --}}
                                            <td class="px-5 py-4">
                                                <div class="flex flex-wrap gap-1.5">
                                                    @forelse($user->roles as $role)
                                                        @if($role->name === 'admin')
                                                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 border border-red-200 shadow-sm">
                                                                Admin
                                                            </span>
                                                        @elseif($role->name === 'editor')
                                                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 border border-blue-200 shadow-sm">
                                                                Editor
                                                            </span>
                                                        @elseif($role->name === 'author')
                                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 border border-green-200 shadow-sm">
                                                                Author
                                                            </span>
                                                        @else
                                                            <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700 border border-gray-200 shadow-sm">
                                                                {{ ucfirst($role->name) }}
                                                            </span>
                                                        @endif
                                                    @empty
                                                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-500 border border-gray-200">
                                                            No Role
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            {{-- Action --}}
                                            <td class="px-5 py-4">
                                                <div class="flex justify-center">
                                                    <a href="{{ route('users.edit', $user) }}"
                                                       class="p-2 rounded-xl bg-blue-100 text-blue-700
                                                              hover:bg-blue-600 hover:text-white
                                                              transition duration-200 shadow-sm
                                                              group-hover:scale-105"
                                                       title="Atur Role">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="py-14 text-center text-gray-500">
                            <p class="text-lg font-semibold">Belum ada user</p>
                            <p class="text-sm mt-1">Data user akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
