<x-app-layout>
    <div class="relative flex items-center justify-center pt-12 pb-6">
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Pilih Metode Pembayaran
        </button>
    </div>

    <div class="mt-2 w-full grid-cols-1 md:grid-cols-2 gap-6 p-2 flex flex-wrap justify-between">
        <div id="cash-payment" class="p-6 shadow-md rounded-lg flex flex-col items-left w-full md:w-1/2 bg-gray-800">
            <div class="flex items-center mb-4">
                <input type="checkbox" id="cash-checkbox" class="mr-2" onclick="togglePayment('cash')">
                <h2 class="text-lg text-center font-semibold text-white">Cash</h2>
            </div>
            <div class="text-sm text-gray-400 w-full">
                <p class="mb-2"> 1. Minta Kode</p>
                <p class="mb-2"> 2. Catat Kode</p>
                <p class="mb-2"> 3. Pergi ke lokasi admin pembayaran</p>
                <p class="mb-2"> 4. Tunjukkan Kode</p>
                <p class="mb-2"> 5. Terima Pembayaran</p>
            </div>

            <form action="{{ route('payment.update', ['id' => request()->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="cash-code" name="cash_code" class="w-full p-1 border border-gray-300 rounded bg-white" value="{{ $payment->cash_code ?? '' }}" readonly>
                <button type="submit" name="generate_cash_code" id="cash-btn"
                    class="text-sm font-bold px-4 py-2 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none mt-2">
                    Minta Kode
                </button>
                @if (!empty($payment->cash_code))
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold px-4 py-2 bg-green-600 text-white rounded-lg shadow-lg focus:outline-none mt-2 ml-2">
                        Selesai
                    </a>
                @endif
            </form>
        </div>

        <div id="transfer-payment" class="p-6 shadow-md rounded-lg flex flex-col w-full md:w-1/2 bg-gray-800">
            <div class="flex items-center mb-4">
                <input type="checkbox" id="transfer-checkbox" class="mr-2" onclick="togglePayment('transfer')">
                <h2 class="text-lg font-semibold text-white">Transfer</h2>
            </div>
            <div class="text-sm text-gray-400 w-full">
                <p class="mb-2"> 1. Kirim nomor Dana/ShopeePay/dll</p>
                <p class="mb-2"> 2. Tunggu konfirmasi</p>
                <p class="mb-2"> 3. Pembayaran akan diproses</p>
            </div>

            <form action="{{ route('payment.update', ['id' => request()->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="transfer-input" name="transfer_payment" class="w-full p-1 border border-gray-300 rounded bg-white" required>
                <button type="submit" id="transfer-btn"
                    class="text-sm font-bold px-4 py-2 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none mt-2">
                    Kirim
                </button>
                @if (!empty($payment->transfer_payment))
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold px-4 py-2 bg-green-600 text-white rounded-lg shadow-lg focus:outline-none mt-2 ml-2">
                        Selesai
                    </a>
                @endif
            </form>
        </div>
    </div>

    <script>
        function togglePayment(method) {
            if (method === 'cash') {
                document.getElementById('cash-checkbox').checked = true;
                document.getElementById('transfer-checkbox').checked = false;
                document.getElementById('cash-payment').classList.remove('bg-gray-500');
                document.getElementById('cash-payment').classList.add('bg-gray-800');
                document.getElementById('transfer-payment').classList.remove('bg-gray-800');
                document.getElementById('transfer-payment').classList.add('bg-gray-500');
                document.getElementById('transfer-input').disabled = true;
                document.getElementById('transfer-btn').disabled = true;
            } else {
                document.getElementById('cash-checkbox').checked = false;
                document.getElementById('transfer-checkbox').checked = true;
                document.getElementById('transfer-payment').classList.remove('bg-gray-500');
                document.getElementById('transfer-payment').classList.add('bg-gray-800');
                document.getElementById('cash-payment').classList.remove('bg-gray-800');
                document.getElementById('cash-payment').classList.add('bg-gray-500');
                document.getElementById('cash-code').disabled = true;
                document.getElementById('cash-btn').disabled = true;
            }
        }
    </script>
</x-app-layout>
