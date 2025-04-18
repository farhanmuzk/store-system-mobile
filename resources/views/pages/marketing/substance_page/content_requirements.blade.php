<x-app-layout>

    <div class="relative flex items-center justify-center pt-12 pb-6">
        <!-- Button Icon di Kiri -->
        <a href="{{ route('substance') }}"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Button Marketing di Tengah -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lgfocus:outline-none">
            Syarat Konten
        </button>
    </div>


    <div class="flex flex-col items-center justify-center px-4">
        <div class="text-sm text-gray-400 bg-gray-800 w-full mt-4 p-4 rounded-md space-y-2">
            <p> 1. Video konten yg berisi keterangan produk harus sesuai dengan keterangan yang tertulis di website Tidak boleh di lebih lebih kan</p>
            <p> 2. Konten produk harus menyertakan logo trendStore sebagai tanda pengenal</p>
            <p> 3. Masukkan kontak mu agar kami bisa mengirim notifikasi pendapatan mu</p>
            <p> 4. Konten harus menyertakan akses pembelian yg di sediakan di bawah ini Akses pembelian tersedia dalam bentuk link,email dan nomor w.a</p>
        </div>
    </div>

    <form action="" method="POST" enctype="multipart/form-data" class="w-full max-w-md mt-6">
        @csrf

        <div class="relative w-[70%] justify-center m-auto ">
            <!-- Ikon di kanan atas -->
            <button type="button" class="absolute top-[-10px] right-[-15px] p-2 bg-gray-600 text-white rounded-full hover:bg-gray-500 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
            </button>

            <!-- Input file -->
            <input type="file" name="gambar" class=" w-full p-2 border border-gray-300 rounded bg-white" required>
        </div>

        <!-- Input Deskripsi & Tombol Simpan -->
        <div class="flex w-[70%] justify-center m-auto mt-4">
            <input type="text" name="deskripsi" placeholder="Masukkan kontak Anda (Email/W.A)" class="text-lg rounded-l-lg" required>
            <button type="submit" class="w-full p-4 text-lg bg-blue-600 text-white rounded-r-lg hover:bg-blue-500 focus:outline-none">
                Simpan
            </button>
        </div>
    </form>



</x-app-layout>
