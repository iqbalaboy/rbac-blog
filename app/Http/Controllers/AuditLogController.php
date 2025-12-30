<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Tampilkan daftar audit log.
     * Batasi akses di route dengan middleware role:admin.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', 'like', '%' . $request->action . '%');
        }

        // Filter by user (nama atau email)
        if ($request->filled('user')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->user . '%')
                    ->orWhere('name', 'like', '%' . $request->user . '%');
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('audit_logs.index', compact('logs'));
    }
}
