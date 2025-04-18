<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('pages.marketing.substance_page.about_product', compact('products'));
    }

    // Menyimpan produk barua
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'spesifikasi' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);

        // Simpan gambar ke folder storage
        $gambarPath = $request->file('gambar')->store('uploads', 'public');
        $validated['gambar'] = $gambarPath;

        Product::create($validated);

        return redirect()->route('pages.marketing.substance_page.about_product')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

}
