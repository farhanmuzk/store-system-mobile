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
            Paying Member
        </button>
    </div>

    <div class="relative" x-data="{ showModal: false }">
        <!-- Tombol Riwayat di kanan atas -->
        <a href="/riwayat"
            class="absolute top-4 right-4 px-4 py-2 bg-gray-700 text-white rounded-md shadow hover:bg-gray-600">
            Riwayat
        </a>

        <!-- Container Chat -->
        @foreach ($data as $item)
            @if ($item->image_bukti)
                <div x-data="{ showModal: false }">
                    <!-- Trigger -->
                    <div class="flex flex-col py-2 px-4 max-w-xl mx-auto">
                        <div class="space-y-1 cursor-pointer" @click="showModal = true">
                            <div class="text-left text-sm text-gray-500">ID: {{ $item->id }}</div>
                            <div class="flex items-start space-x-3">
                                <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                                    class="w-10 h-10 rounded-full object-cover" alt="User">
                                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-xl max-w-[80%]">
                                    Marketing: {{ $item->nama_id ?? 'Staf' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div x-show="showModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
                        <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg max-w-md w-full relative">
                            <img src="{{ asset('storage/' . $item->image_bukti) }}" alt="Preview"
                                class="w-full h-64 object-cover">
                            <div class="flex justify-between px-6 py-4 ">
                                <button
                                    class="px-4 py-2 bg-green-600 text-white hover:bg-green-500 w-[48%] rounded-md">ACC</button>
                                <button
                                    class="px-4 py-2 bg-red-600 text-white hover:bg-red-500 w-[48%] rounded-md">Reject</button>
                            </div>
                            <button @click="showModal = false"
                                class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white text-sm w-8 h-8 flex items-center justify-center rounded-full transition">
                                x
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach


        <div class="flex flex-col py-2 px-4 max-w-xl mx-auto" x-data="{ showModalCash: false }">
            <div class="space-y-1 cursor-pointer" @click="showModalCash = true">
                <div class="text-left text-sm text-gray-500">12 April 2025 - 10:15</div>
                <div class="flex items-start space-x-3">
                    <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                        class="w-10 h-10 rounded-full object-cover" alt="User">
                    <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-xl max-w-[80%]">
                        Marketing: Staf
                        <br> <span>CASH : </span>
                    </div>
                </div>
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

        <div class="flex flex-col py-2 px-4 max-w-xl mx-auto" x-data="{ showModalImage: false }">
            <div class="space-y-1 cursor-pointer" @click="showModalImage = true">
                <div class="text-left text-sm text-gray-500">12 April 2025 - 10:15</div>
                <div class="flex items-start space-x-3">
                    <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                        class="w-10 h-10 rounded-full object-cover" alt="User">
                    <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-xl max-w-[80%]">
                        Marketing: Staf
                        <br> <span>TF : 99999 (Dana)</span>
                    </div>
                </div>
            </div>

            <!-- Modal Input Gambar -->
            <div x-show="showModalImage" x-cloak
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
                <div class="bg-white rounded-xl shadow-lg max-w-md w-full relative p-6">
                    <h2 class="text-lg font-bold mb-4">Upload Bukti Transfer</h2>
                    <input type="file" accept="image/*"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="flex justify-end mt-4">
                        <button @click="showModalImage = false"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">Tutup</button>
                    </div>
                </div>
            </div>
        </div>





    </div>
</x-app-layout>
