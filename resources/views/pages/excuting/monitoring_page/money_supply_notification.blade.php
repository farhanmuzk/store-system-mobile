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
            Money Supply <br> Notification
        </button>
    </div>

    <div
        class="flex flex-col items-start justify-center p-6 py-6 space-y-4 w-full max-w-2xl shadow-xl rounded-2xl text-sm text-white">

        <div
            class="flex flex-col items-start justify-center p-6 py-6 space-y-4 w-full max-w-2xl bg-gray-700 shadow-xl rounded-2xl text-sm text-white">

            <h2 class="text-center mx-auto font-semibold text-xl">*Format Money Supply*</h2>
            <p class="text-center mx-auto font-semibold text-lg text-green-400">- 20 Juni 2023 -</p>
            <div class="w-full flex items-center">
                <div class="flex items-center w-[200px] font-semibold">
                    Nama & ID :
                </div>
                <div class="px-2 w-full ">
                    John Doe - #123456
                </div>
            </div>

            <div class="w-full flex items-center">
                <div class="flex items-center w-[200px] font-semibold">
                    No Telepon :
                </div>
                <div class="px-2 w-full ">
                    0812-3456-7890
                </div>
            </div>

            <div class="w-full flex items-center">
                <div class="flex items-center w-[200px] font-semibold">
                    Tanggal / Bulan :
                </div>
                <div class="px-2 w-full ">
                    13 April 2025
                </div>
            </div>

            <div class="w-full flex items-center">
                <div class="flex items-center w-[200px] font-semibold">
                    Cash :
                </div>
                <div class="px-2 w-full ">
                    Rp 500.000
                </div>
            </div>

            <div class="w-full flex items-center">
                <div class="flex items-center w-[200px] font-semibold">
                    Transfer :
                </div>
                <div class="px-2 w-full ">
                    Rp 500.000
                </div>
            </div>

            <div class="w-full flex items-start">
                <div class="flex items-center w-[200px] font-semibold">
                    Note :
                </div>
                <div class="px-2 w-full text-white">
                    Pembayaran bulan April sudah diterima.
                </div>
            </div>
            <div class="flex flex-col w-full">
                <label for="">Message :</label>
                <input type="text"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan catatan tambahan...">
            </div>
            <div class="flex flex-col w-full">
                <label for="">Upload File :</label>
                <input type="file"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Upload bukti transfer...">
            </div>
            <div class="flex flex-col w-full">
                <label for="">Status :</label>
                <input type="text"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Status">
            </div>
            <div class="flex flex-col w-full">
                <label for="">Feedback :</label>
                <input type="file"
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Upload bukti transfer...">
            </div>
            <button
                class="w-full px-4 py-2 rounded-lg bg-blue-500 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">Kirim</button>
        </div>
    </div>

</x-app-layout>
