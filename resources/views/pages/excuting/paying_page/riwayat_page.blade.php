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
            Riwayat
        </button>
    </div>

    <!-- Parent container with all Alpine.js states -->
    <div x-data="{ selectedFilter: 'Perlu Diperiksa', showOptions: false, showModalCash: false }">

        <!-- Dropdown Filter -->
        <div class="relative w-[300px] mx-auto mb-4">
            <button @click="showOptions = !showOptions"
                class="w-full flex items-center justify-between text-lg font-bold px-6 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
                <span x-text="selectedFilter"></span>
                <svg class="ml-2 w-4 h-4 transform transition-transform duration-200"
                    :class="{ 'rotate-180': showOptions }" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="showOptions" @click.outside="showOptions = false"
                class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-10">
                <ul>
                    <li @click="selectedFilter = 'Perlu Diperiksa'; showOptions = false"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Perlu Diperiksa</li>
                    <li @click="selectedFilter = 'Perlu Dibayar'; showOptions = false"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Perlu Dibayar</li>
                </ul>
            </div>
        </div>

        <!-- Konten berdasarkan filter -->
        <div class="flex flex-col py-2 px-4 max-w-xl mx-auto">
            <!-- Perlu Diperiksa -->
            <template x-if="selectedFilter === 'Perlu Diperiksa'">
                <div class="space-y-1 cursor-pointer" @click="showModalCash = true">
                    <div class="text-left text-sm text-gray-500">12 April 2025 - 10:15</div>
                    <div class="flex items-start space-x-3">
                        <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                            class="w-10 h-10 rounded-full object-cover" alt="User">
                        <div class="bg-yellow-100 text-yellow-900 px-4 py-2 rounded-xl max-w-[80%]">
                            Marketing: Staf
                            <br> <span>Status: Perlu Diperiksa</span>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Perlu Dibayar -->
            <template x-if="selectedFilter === 'Perlu Dibayar'">
                <div class="space-y-1">
                    <div class="text-left text-sm text-gray-500">12 April 2025 - 11:00</div>
                    <div class="flex items-start space-x-3">
                        <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                            class="w-10 h-10 rounded-full object-cover" alt="User">
                        <div class="bg-red-100 text-red-900 px-4 py-2 rounded-xl max-w-[80%]">
                            Marketing: Staf
                            <br> <span>Status: Perlu Dibayar</span>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Modal Input Cash -->
        <div x-show="showModalCash" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
            <div class="bg-white rounded-xl shadow-lg max-w-md w-full relative p-6">
                <h2 class="text-lg font-bold mb-4">Input Nominal Cash</h2>
                <input type="number" placeholder="Masukkan jumlah cash"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div class="flex justify-end mt-4">
                    <button @click="showModalCash = false"
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">Tutup</button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
