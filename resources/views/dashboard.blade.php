<x-app-layout>
    <div class="py-12">
        <div class="flex items-center justify-center m-4">
            <div class="relative w-full max-w-md">
                <input type="text"
                    class="w-full px-4 py-2 pl-10 text-gray-700 bg-white border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                    placeholder="Search..." />
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-search">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center p-4 space-y-4">
            @if (auth()->user()->isAdmin())
                <a href="{{ route('notifications.index') }}"
                    class="self-end px-4 py-2 bg-gray-700 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none"
                    style="max-width: 200px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-bell">
                        <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                        <path
                            d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                    </svg>
                </a>
            @endif
            <a href="{{ route('marketing') }}"
                class="self-start w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
                Marketing
            </a>
            <a href="/negotiation"
                class="self-start w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
                Negotiation
            </a>
            <a href="/excuting"
                class="self-start w-[250px] py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
                Excuting
            </a>
        </div>

    </div>
</x-app-layout>
