<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Menampilkan form edit profil
    public function edit(Request $request): View {
            return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        // Untuk sekarang cukup redirect saja, nanti bisa diisi validasi update profil
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        // Untuk sekarang cukup redirect saja
        return Redirect::route('home');
    }
}
