<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HakAkses;
use Illuminate\Support\Facades\Auth;

class ContentRequirementsController extends Controller
{
    public function show()
{

        // Jika belum terverifikasi, kirimkan ke view tanpa menampilkan hak akses
        return view('pages.marketing.substance_page.content_requirements', [
            'hakAkses' => HakAkses::all(),
        ]);
}

public function store(Request $request)
{
    $request->validate([
        'deskripsi' => 'required|string|email',
    ]);

    $email = $request->deskripsi;

    // Cek apakah email sudah ada di database
    $user = User::where('email', $email)->first();

    if ($user) {
        // Set session untuk hasVerifiedEmail menjadi true
        session(['hasVerifiedEmail' => true]);

        // Arahkan ke route content-requirements dengan data user_id dan status verifikasi
        return redirect()->route('content-requirements', [
            'user_id' => $user->id,
        ]);
    }

    // Jika email tidak ditemukan → beri error validasi
    return redirect()->back()->withErrors(['deskripsi' => 'Email tidak ditemukan di sistem.'])->withInput();
}


public function updateUserHakAkses(Request $request)
    {
        // Validasi input
        $request->validate([
            'hak_akses' => 'required|array|min:1', // Pastikan setidaknya satu checkbox dipilih
            'hak_akses.*' => 'exists:hak_akses,id', // Pastikan ID yang dipilih ada di tabel hak_akses
        ]);

        $user = Auth::user(); // Ambil data user yang sedang login

        // Ambil ID hak akses pertama yang dipilih, jika ada
        $selectedHakAksesId = $request->hak_akses[0];

        // Perbarui id_hak_akses di tabel users
        $user->id_hak_akses = $selectedHakAksesId;
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('content-requirements')->with('success', 'Hak Akses berhasil diperbarui.');
    }
}
