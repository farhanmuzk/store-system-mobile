<x-app-layout>

    <div class="relative flex items-center justify-center pt-12 pb-6">
        <!-- Button Icon di Kiri -->
        <a href="{{ route('marketing') }}"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Button Marketing di Tengah -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lgfocus:outline-none">
            Bahannya
        </button>
    </div>


    <div class="flex flex-col items-center justify-center px-4">
        <div class="text-sm text-gray-400 bg-gray-800 w-full mt-4 p-4 rounded-md space-y-2">
            <p> 1. Temukan semua keperluan konten mu disini</p>
            <p> 2. Buatlah konten sesuai syarat yang tertera</p>
            <p> 3. Tanyakan jika ada yang tidak dimengerti</p>
        </div>
    </div>

    <div class="flex items-center justify-center m-4">
        <div class="relative w-full max-w-md">
            <input type="text"
                class="w-full px-4 py-2 pl-10 text-gray-700 bg-white border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                placeholder="Search..." />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-search">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-8 justify-center items-center text-center m-auto ">
        <a href="/about-product"
            class="w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
            Tetang Produk
        </a>
        <a href="/content-requirements"
            class="w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
            Syarat Konten
        </a>
    </div>

</x-app-layout>
