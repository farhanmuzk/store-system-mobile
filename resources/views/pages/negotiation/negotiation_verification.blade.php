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
        <input type="password" name="contact" required
                class="w-fit text-center text-lg text-gray-700 bg-white border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                placeholder="Masukkan Kontak Anda" value="0895187298170" />
        <a href="https://wa.link/v2o6kg"
                class="text-lg font-bold px-8 py-3 mt-4 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                Hubungi Kontak Diatas
        </a>
        <div class="text-sm text-left text-gray-400 bg-gray-800 w-full my-4 p-4 rounded-md space-y-2">
            <p class="pb-2">Tugasmu adalah:</p>
            <p>-riset barang yang dipromosikan.</p>
            <p>-melayani customer yang menghubungimu.</p>
            <p>- Memberikan format pendapatan kekontak diatas</p>
            <p>-Membuat format pemesanan</p>
            <p>-Menjaga komunikasi dengan costumer hingga barang sampai</p>
            <p class="pt-2">Setelah barang sampai dapatkan notifikasi pendapanmu</p>
        </div>


        @if($negotiation)
            <div class="flex flex-col items-center justify-center space-x-4 mt-4 w-full gap-4 mb-4">
                <a href="/trouble-consultation"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                    Konsultasi Trouble
                </a>
                <div class="flex justify-between space-x-4 w-full">
                    <a href="/product-data"
                        class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                        Data Barang
                    </a>
                    <a href="/payment-page"
                        class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                        Pembayaran
                    </a>
                </div>
                <a href="/incoming-order"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                    Incoming Order
                </a>
            </div>
            <div class="flex items-center justify-center space-x-2 mt-4 w-full gap-2 mb-4">
                <a href="/shipping-estimation"
                    class="text-sm text-center font-bold px-4 py-2 bg-green-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                    Fitur </br> Ongkir & Estimasi
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
