<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
    public function verifyCode(Request $request)
    {
        // Kode rahasia yang diperlukan untuk menjadi admin
        $adminCode = 'SECRET123';

        // Validasi input
        $request->validate([
            'code' => 'required|string',
        ]);

        // Cek apakah kode yang dimasukkan benar
        if ($request->code === $adminCode) {
            $user = Auth::user();
            $user->role = 'admin'; // Ubah role menjadi admin
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Anda sekarang adalah admin!');
        }

        return back()->withErrors(['code' => 'Kode yang Anda masukkan salah.']);
    }

    public function logoutAdmin()
    {
        $user = Auth::user();
        $user->role = 'user';
        $user->save();

        session()->forget('auth_user');
        Auth::setUser($user);

        $dd = Auth::user();
        return redirect()->route('dashboard')->with('success', 'Anda telah keluar dari peran admin.');
    }

}
