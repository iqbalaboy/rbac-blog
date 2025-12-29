{{-- resources/views/users/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Atur Role: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
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
                <div class="mb-4">
                    <p class="text-sm text-gray-600">
                        <strong>Nama:</strong> {{ $user->name }}<br>
                        <strong>Email:</strong> {{ $user->email }}
                    </p>
                </div>

                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">
                            Pilih Role untuk user ini:
                        </p>

                        <div class="space-y-2">
                            @foreach($roles as $role)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="checkbox"
                                           name="roles[]"
                                           value="{{ $role->id }}"
                                           @checked(in_array($role->id, $userRoleIds))
                                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span>{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-6">
                        <a href="{{ route('users.index') }}"
                           class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
                            Kembali
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Simpan Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>