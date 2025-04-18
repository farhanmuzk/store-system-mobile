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

    <div class="flex flex-col items-center justify-center p-4 space-y-6">
        <!-- Input Code Member -->
        <form id="codeForm" class="flex flex-col items-center space-y-2" onsubmit="return validateCode(event)">
            <input
                type="text"
                id="codeInput"
                name="code"
                placeholder="Masukkan Code Member"
                class="w-[250px] py-2 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 mb-10"
            >
            <span id="errorText" class="text-red-500 text-sm hidden">Kode salah. Silakan coba lagi.</span>

            <!-- Button Submit -->
            <button
                type="submit"
                class="w-[150px]  py-2 bg-gray-700 text-white rounded-lg shadow-md text-lg text-center hover:bg-gray-500 focus:outline-none">
                Kirim
            </button>
        </form>
    </div>

    <script>
        function validateCode(event) {
            event.preventDefault();

            const codeInput = document.getElementById('codeInput');
            const errorText = document.getElementById('errorText');
            const codeValue = codeInput.value.trim();

            if (codeValue === "code321") {
                // Redirect jika benar
                window.location.href = "/notifications/order-approval";
            } else {
                // Tampilkan error
                codeInput.classList.add("border-red-500");
                errorText.classList.remove("hidden");
            }
        }
    </script>
</x-app-layout>
