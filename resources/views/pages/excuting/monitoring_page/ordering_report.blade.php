<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <!-- Tombol Kembali -->
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Tombol Send Report -->
        <button
            class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none hover:bg-gray-600">
            Ordering Report
        </button>
    </div>

    <!-- Konten Utama dengan 2 Kolom 50/50 -->
    <div class="px-8 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200">
                <!-- Judul -->
                <h2 class="text-xl text-center font-semibold mb-4 text-white">Notif Earning</h2>
                <div class="relative">
                    <p
                        class="aboslute top-0 left-0 w-full h-full flex items-center justify-left rounded-lg overflow-hidden">
                        <span class="text-gray-200 text-sm">004</span>
                    </p>
                    <div
                        class="w-full flex items-center justify-between bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mb-2">
                        Hari Ini :
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-folder-down-icon lucide-folder-down">
                                <path
                                    d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z" />
                                <path d="M12 10v6" />
                                <path d="m15 13-3 3-3-3" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="relative">
                    <p
                        class="aboslute top-0 left-0 w-full h-full flex items-center justify-left rounded-lg overflow-hidden">
                        <span class="text-gray-200 text-sm">004</span>
                    </p>
                    <div
                        class="w-full flex items-center justify-between bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mb-2">
                        Minggu Lalu :
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-folder-down-icon lucide-folder-down">
                                <path
                                    d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z" />
                                <path d="M12 10v6" />
                                <path d="m15 13-3 3-3-3" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="relative">
                    <p
                        class="aboslute top-0 left-0 w-full h-full flex items-center justify-left rounded-lg overflow-hidden">
                        <span class="text-gray-200 text-sm">004</span>
                    </p>
                    <div
                        class="w-full flex items-center justify-between bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mb-2">
                        07 Januari 2025 :
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-folder-down-icon lucide-folder-down">
                                <path
                                    d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z" />
                                <path d="M12 10v6" />
                                <path d="m15 13-3 3-3-3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 cursor-pointer relative group"
                onclick="document.getElementById('imageInput').click()">
                <textarea name="message" id="" cols="30" rows="10" class="w-full rounded-md"></textarea>
                <button
                    class="w-full bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mt-2">
                    Kirim
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
