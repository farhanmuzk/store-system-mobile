<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <!-- Tombol Kembali -->
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-chevron-left" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Judul Halaman -->
        <button
            class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none hover:bg-gray-600">
            Money Supply
        </button>
    </div>

    <!-- Konten Form -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4" x-data="{ paymentMethod: '' }">
        <div
            class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 cursor-pointer relative group text-white">
            <form method="POST" action="{{ route('money-supply.store') }}" class="space-y-5">
                @csrf
                <!-- Nama & ID -->
                @if (session('success'))
                    <div class="p-3 mb-4 bg-green-600 text-white rounded-lg shadow-md text-sm font-semibold"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div>
                    <label class="block mb-1 text-sm font-medium">Nama & ID</label>
                    <input type="text" name="nama_id" required
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        readonly value="{{ Auth::user()->name . ' - ' . Auth::user()->id }}">

                </div>

                <!-- No Telepon -->
                <div>
                    <label class="block mb-1 text-sm font-medium">No Telepon</label>
                    <input type="tel" name="no_telp" required
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="0812xxxxxxx" value="{{ old('no_telp') }}">
                </div>

                <!-- Tanggal -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" required
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('tanggal') }}">
                </div>

                <!-- Metode Pembayaran -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Metode Pembayaran</label>
                    <select name="payment_method" x-model="paymentMethod" required
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Pilih Metode</option>
                        <option value="Transfer">Transfer</option>
                        <option value="Cash">Cash</option>
                    </select>
                </div>

                <!-- Nomor Transfer -->
                <div x-show="paymentMethod === 'Transfer'" x-transition>
                    <label class="block mb-1 text-sm font-medium mt-3">Nomor Transfer</label>
                    <input type="text" name="nomor_tf"
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nomor transfer" value="{{ old('nomor_tf') }}">
                </div>

                <!-- Catatan -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Catatan</label>
                    <textarea name="note" rows="3"
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Tambahkan catatan...">{{ old('note') }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-between gap-4 pt-2">
                    <button type="reset"
                        class="flex-1 bg-red-600 hover:bg-red-500 text-white py-2 px-4 rounded-lg shadow transition">
                        Reset
                    </button>
                    <button type="submit"
                        class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white py-2 px-4 rounded-lg shadow transition">
                        Kirim
                    </button>
                </div>
            </form>
        </div>

        @foreach ($data as $item)
            @php
                $hasContent = $item->message_admin || $item->image_payment || $item->image_feedback;
            @endphp

            @if ($hasContent)
                <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200">
                    <form method="POST" action="{{ route('money-supply.update', $item->id) }}"
                        enctype="multipart/form-data" class="p-6 mb-6">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" value="{{ $item->id }}">

                        <div>
                            <p class="text-gray-800 text-xs font-semibold bg-green-400 px-3 py-1 w-fit">
                                {{ now()->format('H:i') }}
                            </p>

                            <div class="bg-gray-700 border border-green-500 p-4 text-white space-y-4">
                                <p class="font-semibold text-xs">{{ $item->message_admin ?? 'Tidak ada catatan.' }}</p>

                                <!-- Bukti Upload 1 -->
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-sm text-gray-300 w-24">Bukti</p>
                                    <div class="flex items-center gap-4 flex-1 justify-end">
                                        @if ($item->image_payment)
                                            <img src="{{ asset('storage/' . $item->image_payment) }}"
                                                alt="Bukti Transfer" class="w-32 mb-2 rounded shadow">
                                        @endif
                                    </div>
                                </div>

                                <!-- Bukti Upload 2 (File for Feedback) -->
                                <div class="flex items-center justify-between gap-4">
                                    <p class="text-sm text-gray-300 w-24">Bukti Balik</p>
                                    <div class="flex items-center gap-4 flex-1 justify-end">
                                        <label class="cursor-pointer flex items-center">
                                            <input type="file" class="hidden" name="image_feedback"
                                                id="image_feedback" required onchange="updateFileStatus(this)">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-blue-400 hover:text-blue-500 transition"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" x2="12" y1="3" y2="15" />
                                            </svg>
                                        </label>
                                        <span class="text-sm text-gray-300" id="file-feedback-text">Pilih File</span>
                                    </div>
                                </div>


                                <!-- Submit Button -->
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="bg-emerald-600 hover:bg-emerald-500 text-white py-2 px-4 rounded-lg shadow transition">
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endforeach


    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function updateFileStatus(input) {
            const span = document.getElementById('file-feedback-text');
            if (input.files.length > 0) {
                span.textContent = "File sudah masuk";
                span.classList.remove("text-gray-300");
                span.classList.add("text-green-400");
            } else {
                span.textContent = "Pilih File";
                span.classList.remove("text-green-400");
                span.classList.add("text-gray-300");
            }
        }
    </script>

</x-app-layout>
