<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <a href="/dashboard"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
    </div>

    <!-- Form Utama -->
    <div class="flex flex-col items-center justify-center mt-4 w-full gap-4 mb-4">
        <form method="POST" action="{{ route('verify.code') }}" class="flex flex-col items-center">
            @csrf

            <input type="text" name="code" required
            class="w-[250px] px-4 py-2 pl-10 text-gray-700 bg-white border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
            placeholder="Masukkan Code"
            @if (auth()->user()->isAdmin()) disabled @endif />

            @if (!auth()->user()->isAdmin())
                <!-- Tombol verifikasi hanya muncul jika pengguna adalah "user" -->
                <button type="submit"
                    class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-circle-check">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </button>
            @endif
        </form>

        <!-- Form Logout Admin (Pisahkan dari Form Sebelumnya) -->
        @if (auth()->user()->isAdmin())
            <form method="POST" action="{{ route('logout.admin') }}" id="logout-admin-form">
                @csrf
                <button type="submit" class="m-auto text-lg font-bold px-6 py-2 bg-red-600 text-white rounded-lg shadow-lg hover:bg-red-500 focus:outline-none">
                    Logout Admin
                </button>
            </form>
        @endif
    </div>
</x-app-layout>
