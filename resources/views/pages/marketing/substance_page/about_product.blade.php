<x-app-layout>
    <div class="relative flex items-center justify-center pt-12 pb-6">
        <!-- Tombol Kembali -->
        <a href="{{ route('substance') }}"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Judul -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Tentang Produk
        </button>
    </div>

    <div class="p-4">
        <!-- Tabel Produk -->
        <div class="overflow-x-auto overflow-y-auto max-h-96 border border-gray-300 rounded-lg shadow-md">
            <table id="data-table" class="w-full border-collapse text-sm bg-white">
                <thead class="bg-gray-700 text-white sticky top-0">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Gambar</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Spesifikasi</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Harga</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Keuntungan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Form Input Produk -->
                    <tr>
                        <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <td class="border border-gray-300 px-4 py-2">#</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="file" name="gambar" accept="image/*"
                                    class="p-2 border border-gray-300 rounded bg-white" required>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="text" name="spesifikasi" placeholder="Masukkan spesifikasi"
                                    class="p-2 border border-gray-300 rounded w-full" required>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="number" name="harga" placeholder="Masukkan harga"
                                    class="p-2 border border-gray-300 rounded w-full" required>
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <input type="number" name="keuntungan" placeholder="Masukkan keuntungan"
                                    class="p-2 border border-gray-300 rounded w-full" required>
                            </td>
                        </form>
                    </tr>

                    <!-- Data Produk -->
                    @foreach ($products as $index => $product)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" class="h-16">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->spesifikasi }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($product->keuntungan, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Simpan -->
    <button type="submit" form="product-form"
        class="fixed bottom-8 right-8 w-12 h-12 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none text-2xl font-bold">
        +
    </button>
</x-app-layout>
