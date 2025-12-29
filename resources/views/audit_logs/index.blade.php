{{-- resources/views/audit_logs/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Audit Log Aktivitas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if($logs->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-3 py-2 border text-left">Waktu</th>
                                <th class="px-3 py-2 border text-left">User</th>
                                <th class="px-3 py-2 border text-left">Aksi</th>
                                <th class="px-3 py-2 border text-left">Objek</th>
                                <th class="px-3 py-2 border text-left">IP</th>
                                <th class="px-3 py-2 border text-left">User Agent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="px-3 py-2 border">
                                    {{ $log->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                <td class="px-3 py-2 border">
                                    {{ $log->user->name ?? '-' }}
                                    <div class="text-xs text-gray-500">
                                        {{ $log->user->email ?? '' }}
                                    </div>
                                </td>
                                <td class="px-3 py-2 border">
                                    <span class="font-mono text-xs bg-gray-100 rounded px-2 py-0.5">
                                        {{ $log->action }}
                                    </span>
                                    @if($log->description)
                                    <div class="text-xs text-gray-600 mt-1">
                                        {{ $log->description }}
                                    </div>
                                    @endif
                                </td>
                                <td class="px-3 py-2 border text-xs">
                                    {{ $log->auditable_type ?? '-' }}
                                    @if($log->auditable_id)
                                    (ID: {{ $log->auditable_id }})
                                    @endif
                                </td>
                                <td class="px-3 py-2 border text-xs">
                                    {{ $log->ip_address }}
                                </td>
                                <td class="px-3 py-2 border text-xs max-w-xs truncate">
                                    {{ $log->user_agent }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
                @else
                <p class="text-gray-600 text-sm">
                    Belum ada aktivitas yang tercatat.
                </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>