<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductData;
use App\Models\MarketingEarning;

class ProductDataController extends Controller
{
    public function index()
    {
        $products = ProductData::latest()->get();
        $marketings = MarketingEarning::latest()->get(); // Tambahkan ini
        return view('pages.negotiation.data_items_page.index', compact('products', 'marketings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'required|string|max:255',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'earning_negosiator' => 'required|numeric',
            'earning_marketing' => 'required|numeric',
        ]);

        // Upload file
        $gambarPath = $request->file('gambar')->store('uploads', 'public');
        $validated['gambar'] = $gambarPath;

        ProductData::create($validated);

        return redirect()->route('product-data')->with('success', 'Produk berhasil ditambahkan!');
    }

}
