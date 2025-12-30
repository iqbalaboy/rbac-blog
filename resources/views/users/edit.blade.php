{{-- resources/views/users/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Role User
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h1 class="text-2xl font-bold">Edit Role</h1>
                <p class="text-sm text-gray-500">
                    Atur role untuk user berikut.
                </p>
            </div>

            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-200 rounded text-sm">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-200 rounded text-sm">
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 border border-red-200 rounded text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <p class="text-sm text-gray-600">
                        Nama:
                        <span class="font-semibold text-gray-900">
                            {{ $user->name }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-600">
                        Email:
                        <span class="font-mono text-gray-900">
                            {{ $user->email }}
                        </span>
                    </p>
                </div>

                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">
                            Role
                        </p>

                        <div class="space-y-2">
                            @foreach($roles as $role)
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                                <input
                                    type="checkbox"
                                    name="roles[]"
                                    value="{{ $role->id }}"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                    {{ in_array($role->id, $userRoleIds) ? 'checked' : '' }}>
                                <span>
                                    {{ ucfirst($role->name) }}
                                    @if($role->name === 'admin')
                                    <span class="ml-1 text-xs text-red-600">(akses penuh)</span>
                                    @elseif($role->name === 'editor')
                                    <span class="ml-1 text-xs text-blue-600">(review & publish)</span>
                                    @elseif($role->name === 'author')
                                    <span class="ml-1 text-xs text-green-600">(buat konten)</span>
                                    @endif
                                </span>
                            </label>
                            @endforeach
                        </div>

                        <p class="mt-2 text-xs text-gray-500">
                            Catatan: Anda tidak dapat menghapus semua role dari akun Anda sendiri.
                        </p>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded text-sm">
                            Kembali
                        </a>

                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>