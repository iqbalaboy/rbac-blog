<!-- {{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-widest text-blue-500 font-semibold">
                Akun
            </p>
            <h2 class="mt-1 font-bold text-2xl text-gray-900 leading-tight">
                Pengaturan Profil
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola informasi profil, email, dan keamanan akun Anda.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Informasi profil --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Ubah password --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Hapus akun --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> -->
{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs uppercase tracking-widest text-blue-500 font-semibold">
                Akun
            </p>
            <h2 class="mt-1 font-bold text-2xl text-gray-900 leading-tight">
                Pengaturan Profil
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Halaman ini dari file: resources/views/profile/edit.blade.php
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    <p class="text-xs text-gray-400 mb-4">
                        DEBUG: Jika kamu melihat teks ini, berarti view profile/edit.blade.php sudah dipakai.
                    </p>

                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>