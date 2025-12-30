{{-- resources/views/audit_logs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Audit Log
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Filter Card --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                <div class="p-6 bg-gradient-to-r from-indigo-50 to-blue-50 border-b rounded-t-2xl">
                    <h3 class="text-lg font-semibold text-gray-900">Filter Audit Log</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Cari aktivitas berdasarkan user dan action
                    </p>
                </div>

                <div class="p-6">
                    <form method="GET" action="{{ route('audit-logs.index') }}"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 items-end">

                        <div>
                            <label for="user" class="block text-xs font-semibold text-gray-600">
                                User
                            </label>
                            <input type="text" name="user" id="user"
                                value="{{ request('user') }}"
                                placeholder="Nama atau email"
                                class="mt-1 w-full rounded-lg border-gray-300 text-smfocus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="action" class="block text-xs font-semibold text-gray-600">
                                Action
                            </label>
                            <input type="text" name="action" id="action"
                                value="{{ request('action') }}"
                                placeholder="contoh: post.approved"
                                class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex gap-2 md:col-span-2">
                            <button type="submit"
                                class="px-4 py-2 rounded-xl bg-blue-600 text-white text-sm hover:bg-blue-700 transition shadow">
                                Filter
                            </button>

                            <a href="{{ route('audit-logs.index') }}"
                                class="px-4 py-2 rounded-xl bg-gray-100 text-gray-700 text-smhover:bg-gray-200 transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed text-sm">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="w-2/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    Waktu
                                </th>
                                <th class="w-3/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    User
                                </th>
                                <th class="w-2/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    Action
                                </th>
                                <th class="w-3/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    Deskripsi
                                </th>
                                <th class="w-2/12 px-5 py-3 text-left text-xs font-semibold text-gray-600 uppercase">
                                    IP Address
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($logs as $log)
                            @php
                            $actionClass = match(true) {
                            str_contains($log->action, 'create') => 'bg-green-100 text-green-700 border-green-200',
                            str_contains($log->action, 'update') => 'bg-blue-100 text-blue-700 border-blue-200',
                            str_contains($log->action, 'approve') => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                            str_contains($log->action, 'reject') => 'bg-red-100 text-red-700 border-red-200',
                            str_contains($log->action, 'delete') => 'bg-red-100 text-red-700 border-red-200',
                            default => 'bg-gray-100 text-gray-700 border-gray-200',
                            };
                            @endphp

                            <tr class="hover:bg-blue-50/40 transition">
                                {{-- Waktu --}}
                                <td class="px-5 py-4 text-xs text-gray-500 whitespace-nowrap">
                                    {{ $log->created_at->format('d M Y') }}<br>
                                    <span class="text-gray-400">
                                        {{ $log->created_at->format('H:i:s') }}
                                    </span>
                                </td>

                                {{-- User --}}
                                <td class="px-5 py-4">
                                    @if($log->user)
                                    <div class="font-semibold text-gray-900">
                                        {{ $log->user->name }}
                                    </div>
                                    <div class="text-xs text-gray-500 truncate">
                                        {{ $log->user->email }}
                                    </div>
                                    @else
                                    <span class="text-xs text-gray-500 italic">
                                        User deleted
                                    </span>
                                    @endif
                                </td>

                                {{-- Action --}}
                                <td class="px-5 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full border {{ $actionClass }}">
                                        {{ $log->action }}
                                    </span>
                                </td>

                                {{-- Deskripsi --}}
                                <td class="px-5 py-4 text-gray-700">
                                    {{ $log->description }}
                                </td>

                                {{-- IP --}}
                                <td class="px-5 py-4 text-xs text-gray-500">
                                    {{ $log->ip_address ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    <p class="text-lg font-semibold">Belum ada audit log</p>
                                    <p class="text-sm mt-1">
                                        Aktivitas sistem akan muncul di sini
                                    </p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-6">
                    {{ $logs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>