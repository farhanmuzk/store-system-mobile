<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <!-- Button Icon di Kiri -->
        <a href="/paying"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Button Marketing di Tengah -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Paying
        </button>
    </div>

    <div class="flex flex-col items-center justify-center px-4 space-y-4">
        <!-- Baris Pertama: 2 tombol -->
        <div class="flex gap-4 w-full max-w-md">
            <a href="/money-supply"
                class="flex-1 bg-gray-700 text-white py-3 rounded-lg shadow transition p-2 text-center ">
                Money Supply
            </a>
            <a href="/paying-member"
                class="flex-1 bg-gray-700 text-white py-3 rounded-lg shadow  transition p-2 text-center">
                Paying Member
            </a>
        </div>
        <a href="/send-report-paying"
            class="w-[200px] bg-gray-700 text-white py-3 rounded-lg shadow transition p-2 text-center">
            Send Report
        </a>
    </div>
</x-app-layout>
