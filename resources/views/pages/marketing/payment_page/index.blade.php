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
            Bayarannya
        </button>
    </div>

    <div class="flex flex-col items-center justify-center px-4">
        <div class="text-sm text-gray-400 bg-gray-800 w-full mt-4 p-4 rounded-md space-y-2">
            <p> 1. Screenshot notif w.a pendapatan</p>
            <p> 2. Upload dan kirim screenshot</p>
            <p> 3. Pilih metode pembayaran</p>
        </div>
    </div>

    @php
        $payment = \App\Models\Payment::where('user_id', auth()->id())
            ->latest()
            ->first();
        $latestNotification = $payment
            ? \App\Models\Notification::where('image', $payment->image)->latest()->first()
            : null;
    @endphp
    @if ($latestNotification && $latestNotification->status === 'rejected')
    <div class="mt-4 flex justify-center">
        <div class="text-sm text-red-500 border border-red-500 bg-red-50 p-4 rounded-xl font-semibold text-center max-w-md w-full">
            Bukti sebelumnya ditolak, silakan kirim ulang!
        </div>
    </div>
    @endif


    @if (!$payment || ($latestNotification && $latestNotification->status === 'rejected'))
        {{-- Jika belum ada payment atau notifikasi terakhir rejected, tampilkan form --}}
        <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data"
            class="w-full max-w-md mt-6">
            @csrf
            <div class="relative w-[70%] justify-center m-auto">
                <input type="file" name="gambar" class="w-full p-2 border border-gray-300 rounded bg-white"
                    required>
            </div>
            <button type="submit"
                class="flex w-[200px] justify-center m-auto mt-6 py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg hover:bg-gray-500 focus:outline-none">
                Kirim
            </button>
        </form>
    @elseif (!$payment->cash_code && !$payment->transfer_payment)
        {{-- Jika payment ada dan belum isi metode pembayaran --}}
        <a href="{{ route('pages.marketing.payment_page.payment_choice', ['id' => $payment->id]) }}"
            class="flex flex-col items-center w-[200px] justify-center m-auto mt-6 py-4 bg-gray-700 text-white rounded-lg shadow-md text-lg hover:bg-gray-500 focus:outline-none">
            Bukti pendapatan <span>{{ $payment->created_at->format('d-m-Y') }}</span>
        </a>
    @endif

</x-app-layout>
