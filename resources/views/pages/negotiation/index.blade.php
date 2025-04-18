<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <!-- Button Icon di Kiri -->
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Button Marketing di Tengah -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Negotiation
        </button>
    </div>

    <div class="flex flex-col items-center justify-center px-4">
        <div class="text-sm text-center text-gray-400 bg-gray-800 w-full my-4 p-4 rounded-md space-y-2">
            <p>Daftarkan kontak yang akan digunakan untuk melayani customer (nomor WhatsApp, Telegram, email, dll.)</p>
        </div>

        @if ($negotiation)
            <!-- Jika data sudah ada, tampilkan tombol "Masuk" -->
            <a href="{{ route('negotiation.verification') }}"
                class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                Masuk
            </a>
        @else
            <!-- Jika data belum ada, tampilkan form input -->
            <form action="{{ route('negotiation.store') }}" method="POST">
                @csrf
                <input type="text" name="contact" required
                    class="w-full px-4 py-2 pl-10 text-gray-700 bg-white border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                    placeholder="Masukkan Kontak Anda" value="{{ old('contact') }}" />

                <button type="submit"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none mt-2">
                    Kirim
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
