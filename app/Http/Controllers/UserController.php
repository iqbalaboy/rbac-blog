<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user dengan roles (biar tidak N+1)
        $users = User::with('roles')->orderBy('name')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $userRoleIds = $user->roles->pluck('id')->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoleIds'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles'   => ['array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        // Role yang dipilih (boleh kosong)
        $roleIds = $validated['roles'] ?? [];

        // Jangan sampai admin menghapus semua role dari dirinya sendiri (opsional tapi aman)
        if ($user->id === auth()->id()->id && empty($roleIds)) {
            return back()->with('error', 'Anda tidak bisa menghapus semua role dari akun Anda sendiri.');
        }

        $user->roles()->sync($roleIds);

        return redirect()
            ->route('users.index')
            ->with('success', 'Role user berhasil diperbarui.');
    }
}
