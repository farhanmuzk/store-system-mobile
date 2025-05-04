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

        <!-- Judul -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Money Supply <br> Notification
        </button>
    </div>

    @foreach ($data as $item)
        <div class="flex flex-col items-center my-4 justify-center px-4 w-full max-w-2xl mx-auto">
            <div class=" bg-gray-700 shadow-xl p-6 rounded-2xl text-sm text-white">
                <h2 class="text-center font-semibold text-xl">*Format Money Supply*</h2>
                <p class="text-center font-semibold text-lg text-green-400">-
                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }} -</p>

                <!-- Informasi Data -->
                <div class="w-full space-y-3 mt-4">
                    <div class="flex">
                        <div class="w-[200px] font-semibold">Nama & ID :</div>
                        <div>{{ $item->nama_id }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-[200px] font-semibold">No Telepon :</div>
                        <div>{{ $item->no_telp }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-[200px] font-semibold">Tanggal / Bulan :</div>
                        <div>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-[200px] font-semibold">Metode :</div>
                        <div>{{ $item->payment_method }}</div>
                    </div>
                    <div class="flex">
                        <div class="w-[200px] font-semibold">No Transfer :</div>
                        <div>{{ $item->nomor_tf ?? '-' }}</div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-[200px] font-semibold">Note :</div>
                        <div>{{ $item->note ?? '-' }}</div>
                    </div>
                </div>

                <!-- Form Update oleh Admin -->
                <form action="{{ route('monitoring-supply.update') }}" method="POST" enctype="multipart/form-data"
                    class="w-full mt-6 space-y-4">
                    @csrf

                    <div class="flex flex-col w-full">
                        <label for="message_admin">Message :</label>
                        <input type="text" name="message_admin" id="message_admin"
                            value="{{ old('message_admin', $item->message_admin) }}"
                            class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukkan catatan tambahan..."
                            @if ($item->message_admin) readonly @endif> <!-- readonly jika sudah ada data -->
                    </div>

                    <!-- Image Payment -->
                    <div class="flex flex-col w-full">
                        <label for="image_payment">Upload Bukti Transfer:</label>
                        @if ($item->image_payment)
                            <!-- Jika ada image_payment -->
                            <img src="{{ asset('storage/' . $item->image_payment) }}" alt="Bukti Transfer"
                                class="w-32 mb-2 rounded shadow">
                            <input type="file" name="image_payment" id="image_payment" class="hidden">
                            <!-- Sembunyikan input file -->
                        @else
                            <input type="file" name="image_payment" id="image_payment"
                                class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600">
                        @endif
                    </div>

                    <div class="flex flex-col w-full">
                        <label for="type_payment">Status :</label>
                        @if ($item->type_payment === 'pending')
                            <!-- Jika statusnya masih pending, tampilkan sebagai read-only input -->
                            <input type="text" name="type_payment" id="type_payment" value="Pending"
                                class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600"
                                readonly>
                        @else
                            <!-- Jika status sudah diperbarui, tampilkan status yang telah diperbarui -->
                            <input type="text" name="type_payment" id="type_payment"
                                value="{{ ucfirst($item->type_payment) }}"
                                class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600"
                                readonly>
                        @endif
                    </div>


                    @if ($item->type_payment === 'completed')
                        <div class="flex flex-col w-full">
                            <label for="image_feedback">Feedback File:</label>
                            @if ($item->image_feedback)
                                <img src="{{ asset('storage/' . $item->image_feedback) }}" alt="Feedback"
                                    class="w-32 mb-2 rounded shadow">
                            @endif
                        </div>
                    @endif

                    <button type="submit"
                        class="w-full px-4 py-2 rounded-lg bg-blue-500 text-white border border-gray-600 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Kirim Pembaruan
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</x-app-layout>
