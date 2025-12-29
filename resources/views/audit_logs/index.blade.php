{{-- resources/views/audit_logs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Audit Log
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form method="GET" action="{{ route('audit-logs.index') }}" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label for="user" class="block text-xs font-medium text-gray-600">
                            User (nama/email)
                        </label>
                        <input type="text" name="user" id="user"
                               value="{{ request('user') }}"
                               class="mt-1 block w-full border-gray-300 rounded shadow-sm text-sm">
                    </div>

                    <div>
                        <label for="action" class="block text-xs font-medium text-gray-600">
                            Action
                        </label>
                        <input type="text" name="action" id="action"
                               value="{{ request('action') }}"
                               placeholder="cth: post.approved"
                               class="mt-1 block w-full border-gray-300 rounded shadow-sm text-sm">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-3 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                            Filter
                        </button>
                        <a href="{{ route('audit-logs.index') }}"
                           class="px-3 py-2 bg-gray-100 text-gray-800 rounded text-sm">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="px-3 py-2 border">Waktu</th>
                            <th class="px-3 py-2 border">User</th>
                            <th class="px-3 py-2 border">Action</th>
                            <th class="px-3 py-2 border">Deskripsi</th>
                            <th class="px-3 py-2 border">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td class="px-3 py-2 border text-xs text-gray-600 whitespace-nowrap">
                                    {{ $log->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="px-3 py-2 border">
                                    @if($log->user)
                                        <div class="font-medium text-gray-800">
                                            {{ $log->user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->user->email }}
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500">[user deleted]</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 border">
                                    <span class="px-2 py-0.5 text-xs rounded bg-gray-100 text-gray-800 border border-gray-200">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 border">
                                    {{ $log->description }}
                                </td>
                                <td class="px-3 py-2 border text-xs text-gray-500">
                                    {{ $log->ip_address ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-4 text-center text-gray-500">
                                    Belum ada data audit log.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>