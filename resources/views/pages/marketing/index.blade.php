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
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lgfocus:outline-none">
            Marketing
        </button>
    </div>


    <div class="flex flex-col items-center justify-center px-4">
        <div class="relative w-full max-w-sm">
            <img src="https://i.pinimg.com/236x/9b/46/e9/9b46e9693a43b7a26e9a0526cb1eb208.jpg" alt="Descriptive Image"
                class="w-full rounded-lg shadow-lg" />
            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent rounded-lg"></div>
        </div>

        <!-- Deskripsi -->
        <p class="mt-4 text-sm indent-4 text-center text-gray-400">
            Tugas mu adalah membuat kali pancing yang menarik, meletakan nya ditempat yang banyak ikan dan menyiapkan
            ember untuk mengumpulkan ikan.
        </p>
        <div class="text-sm text-gray-400 bg-gray-800 w-full mt-4 p-4 rounded-md space-y-2">
            <p>- Buatlah konten barang postingan, gambar, video atau ataupun</p>
            <p>- Upload konten di media pilihanmu (tiktok, Youtube, ataupun Instagram)</p>
            <p>- Siapkan akses untuk konsumen jika ingin tanya" atau membeli</p>

        </div>
        <div class="flex flex-col items-center justify-center space-x-4 mt-4 w-full gap-4 mb-4">
            <a href = "/content/1"
                class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                Contohnya
            </a>
            <div class="flex justify-between space-x-4 w-full">
                <a href = "/substance"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                    Bahannya
                </a>
                <a href="/payment-page"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                    Bayarannya
                </a>
            </div>
            <a href = "/phone-number"
                class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
                Tekan Jika Mau Nanya
            </a>
        </div>
    </div>
</x-app-layout>
