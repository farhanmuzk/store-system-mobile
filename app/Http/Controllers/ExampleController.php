<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($page = 1)
{
    // Cast $page menjadi integer untuk mencegah error non-numeric
    $page = (int) $page;

    // Data dinamis berdasarkan halaman
    $data = [
        1 => [
            'image1' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image2' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image3' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image4' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'text1' => '1. Buka website Trend Store lalu tekan "marketing"',
            'text2' => '2. Buka website Trend Store lalu tekan "marketing"',
            'nextLink' => route('content.page', ['page' => 2]),
            'prevLink' => route('content.page', ['page' => 0]),
        ],
        2 => [
            'image1' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image2' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image3' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image4' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'text1' => 'Setelah memperoleh data barang kamu boleh mencari referensi produk serupa di google atau semacamnya',
            'text2' => 'Kamu bisa langsung buat konten produk nya dalam bentuk video postingan atau lainnya mainkan startegi mu disini',
            'nextLink' => route('content.page', ['page' => 3]),
            'prevLink' => route('content.page', ['page' => 1]),
        ],
        3 => [
            'image1' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image2' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image3' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'image4' => 'https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg',
            'text1' => 'Setelah selesai membuat konten sertakan informasi tambahan yang ada di halaman "bahannya" ikuti petunjuk disana',
            'text2' => 'Setelah itu posting/upload konten mu di platform pilihan mu mainkan taktik mu juga disini',
            'nextLink' => route('content.page', ['page' => 1]),
            'prevLink' => route('content.page', ['page' => 2]),
        ],
    ];

    // Pastikan data halaman ada, jika tidak kembali ke halaman pertama
    $pageData = $data[$page] ?? $data[1];

    return view('content-page', compact('pageData'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
