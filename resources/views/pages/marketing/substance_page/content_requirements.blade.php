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
            <p>1. Video konten yg berisi keterangan produk harus sesuai dengan keterangan yang tertulis di website.
                Tidak boleh di lebih-lebihkan.</p>
            <p>2. Konten produk harus menyertakan logo trendStore sebagai tanda pengenal.</p>
            <p>3. Masukkan kontak mu agar kami bisa mengirim notifikasi pendapatan mu.</p>
            <p>4. Konten harus menyertakan akses pembelian yg disediakan di bawah ini. Akses pembelian tersedia dalam
                bentuk link, email, dan nomor WA.</p>
        </div>
    </div>

    @php
        $currentUser = Auth::user();
    @endphp

    @if (session('success'))
        <div class="text-green-500 text-center mt-4">{{ session('success') }}</div>
    @endif

    @if ($currentUser->id_hak_akses)
        <!-- Menampilkan Pesan Jika Hak Akses Sudah Dimiliki -->
        <div class="text-green-500 text-center mt-4">Hak akses sudah dimiliki : {{ $currentUser->id_hak_akses }}.</div>
    @else
        @php
            $hasVerifiedEmail = session('hasVerifiedEmail', false); // Ambil status dari session
        @endphp

        @if ($hasVerifiedEmail)
            <!-- Menampilkan Daftar Kontak Hak Akses Hanya Jika Email Sudah Diverifikasi -->
            <form action="{{ route('update-user-hak-akses') }}" method="POST" id="hakAksesForm">
                @csrf
                <div class="mt-6 w-full max-w-2xl mx-auto bg-gray-800 text-white p-4 rounded">
                    <h3 class="text-lg font-semibold mb-2">Daftar Kontak Hak Akses</h3>
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="border-b border-gray-600">
                                <th class="text-left p-2">Pilih</th>
                                <th class="text-left p-2">Email</th>
                                <th class="text-left p-2">No WA</th>
                                <th class="text-left p-2">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hakAkses as $akses)
                                <tr class="border-b border-gray-700">
                                    <td class="p-2">
                                        <input type="checkbox" name="hak_akses[]" class="hak-akses-checkbox"
                                            value="{{ $akses->id }}"
                                            {{ $currentUser->id_hak_akses == $akses->id ? 'checked' : '' }}>
                                    </td>
                                    <td class="p-2">{{ $akses->email ?? '-' }}</td>
                                    <td class="p-2">{{ $akses->no_wa ?? '-' }}</td>
                                    <td class="p-2">{{ $akses->link ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Update Hak
                        Akses</button>
                </div>
            </form>
        @else
            <!-- Menampilkan pesan bahwa email belum terverifikasi -->
            <form action="{{ route('content-requirements.store') }}" method="POST" enctype="multipart/form-data"
                class="w-full max-w-md mt-6">
                @csrf
                <div class="flex w-[70%] justify-center m-auto mt-4">
                    <input type="text" name="deskripsi" placeholder="Masukkan kontak Anda (Email/W.A)"
                        class="text-lg rounded-l-lg w-full p-2" value="{{ old('deskripsi', $currentUser->email) }}"
                        required>
                    <button type="submit"
                        class="p-2 text-lg bg-blue-600 text-white rounded-r-lg hover:bg-blue-500 focus:outline-none">
                        Simpan
                    </button>
                </div>
            </form>
        @endif

        <!-- Form untuk Masukkan Kontak (Email/W.A) -->

    @endif
    <script>
        // Ambil elemen gambar dan ikon download
        const downloadIcon = document.getElementById('downloadIcon');
        const imageToDownload = document.getElementById('imageToDownload');

        // Menambahkan event listener pada ikon download
        downloadIcon.addEventListener('click', () => {
            // Membuat elemen <a> untuk mengunduh gambar
            const a = document.createElement('a');
            a.href = imageToDownload.src; // Mengambil URL gambar dari src
            a.download = 'downloaded-image.png'; // Nama file yang akan diunduh
            document.body.appendChild(a);
            a.click(); // Memicu klik untuk mengunduh
            document.body.removeChild(a); // Menghapus elemen <a> setelah klik
        });
    </script>
</x-app-layout>
