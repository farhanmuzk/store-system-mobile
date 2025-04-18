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
    <div class="flex flex-col items-center justify-center p-4 space-y-8">
        <a href="/monitoring"
            class="w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
            Monitoring
        </a>
        <a href="/paying"
            class="w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
            Paying
        </a>
        <a href="/ordering"
            class="w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
            Orderring
        </a>
    </div>
</x-app-layout>
