<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingEarning;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MarketingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telp' => 'required|string|max:20',
            'nama_produk' => 'required|string|max:255',
            'earning' => 'required|numeric',
            'hari_tanggal' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('uploads', 'public');

        MarketingEarning::create([
            'nama' => $validated['nama'],
            'nomor_telp' => $validated['nomor_telp'],
            'nama_produk' => $validated['nama_produk'],
            'earning' => $validated['earning'],
            'hari_tanggal' => $validated['hari_tanggal'],
            'gambar' => $gambarPath,
            'code_earning' => 'EARN-' . strtoupper(Str::random(8)),
        ]);

        return redirect()->route('product-data')->with('marketing_success', 'Data marketing berhasil disimpan!');
    }
}
