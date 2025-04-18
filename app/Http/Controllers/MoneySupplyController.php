<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneySupply;

class MoneySupplyController extends Controller
{
    public function index()
    {
        // Ambil semua data money supply
        $data = MoneySupply::all();
        // dd(request()->route()->getName());
        // Cek nama route yang sedang diakses
        if (request()->routeIs('money-supply')) {
            return view('pages.excuting.paying_page.money_supply', compact('data'));
        }

        return view('pages.excuting.paying_page.paying_member', compact('data'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_id' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'payment_method' => 'required|string|in:Transfer (Dana),Transfer (Gopay),Cash',
            'nomor_tf' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ]);

        // Jika pembayaran transfer, nomor_tf wajib
        if (str_starts_with($validated['payment_method'], 'Transfer') && empty($validated['nomor_tf'])) {
            return back()->withErrors(['nomor_tf' => 'Nomor transfer wajib diisi untuk metode transfer.'])->withInput();
        }

        MoneySupply::create($validated);

        return redirect()->route('money-supply')->with('success', 'Data berhasil dikirim!');
    }
    public function uploadMoneySupply(Request $request)
    {
        $request->validate([
            'money_supply_id' => 'required|exists:money_supplies,id',
            'image_bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'image_bukti_balik' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $moneySupply = MoneySupply::find($request->money_supply_id);

        $path1 = $request->file('image_bukti')->store('bukti-notif', 'public');
        $path2 = $request->file('image_bukti_balik')->store('bukti-notif', 'public');

        // Simpan ke database
        $moneySupply->update([
            'image_bukti' => $path1,
            'image_bukti_balik' => $path2,
        ]);

        return back()->with('success', 'Bukti notifikasi berhasil diunggah.');
    }

}
