{{-- resources/views/users/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
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

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-3 py-2 border text-left">Nama</th>
                            <th class="px-3 py-2 border text-left">Email</th>
                            <th class="px-3 py-2 border text-left">Role</th>
                            <th class="px-3 py-2 border text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-3 py-2 border">
                                    {{ $user->name }}
                                </td>
                                <td class="px-3 py-2 border">
                                    {{ $user->email }}
                                </td>
                                <td class="px-3 py-2 border">
                                    @if($user->roles->count())
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($user->roles as $role)
                                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500">Tidak ada role</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 border text-sm">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">
                                        Atur Role
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>