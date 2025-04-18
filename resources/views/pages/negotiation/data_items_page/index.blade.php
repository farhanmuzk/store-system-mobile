<x-app-layout>
    <div class="relative flex items-center justify-center pt-12 pb-6 bg-gray-900 text-gray-100">
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-800 text-white rounded-full shadow hover:bg-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>
        <span class="text-lg font-semibold px-6 py-2 bg-gray-800 rounded-lg shadow">
            Tentang Produk
        </span>
    </div>

    <div class="p-4 bg-gray-900 text-gray-100 min-h-screen">
        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-700 text-white p-3 mb-4 rounded shadow">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Produk --}}
        <form id="product-form" action="{{ route('product-data.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="overflow-x-auto max-h-[500px] border border-gray-600 rounded-lg shadow">
                <table class="min-w-[900px] w-full text-sm bg-gray-800 text-gray-100">
                    <thead class="bg-gray-700 sticky top-0">
                        <tr>
                            <th class="px-3 py-2 border border-gray-700">No</th>
                            <th class="px-3 py-2 border border-gray-700">Gambar</th>
                            <th class="px-3 py-2 border border-gray-700">Keterangan</th>
                            <th class="px-3 py-2 border border-gray-700">Harga Jual</th>
                            <th class="px-3 py-2 border border-gray-700">Stok</th>
                            <th class="px-3 py-2 border border-gray-700">Earning Negosiator</th>
                            <th class="px-3 py-2 border border-gray-700">Earning Marketing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-900 hover:bg-gray-700">
                            <td class="px-3 py-2 border border-gray-700 text-center">*</td>
                            @foreach (['gambar', 'keterangan', 'harga_jual', 'stok', 'earning_negosiator', 'earning_marketing'] as $field)
                                <td class="px-3 py-2 border border-gray-700">
                                    <input type="{{ $field == 'gambar' ? 'file' : ($field == 'keterangan' ? 'text' : 'number') }}"
                                        name="{{ $field }}"
                                        placeholder="Masukkan {{ str_replace('_', ' ', $field) }}"
                                        class="w-full p-2 bg-gray-700 text-gray-100 border border-gray-600 rounded shadow-inner focus:outline-none focus:ring focus:ring-blue-500"
                                        required>
                                </td>
                            @endforeach
                        </tr>

                        @foreach ($products as $index => $product)
                            <tr class="bg-gray-800 hover:bg-gray-700">
                                <td class="px-3 py-2 border border-gray-700 text-center">{{ $index + 1 }}</td>
                                <td class="px-3 py-2 border border-gray-700">
                                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk {{ $product->id }}"
                                        class="h-14 mx-auto rounded shadow">
                                </td>
                                <td class="px-3 py-2 border border-gray-700">{{ $product->keterangan }}</td>
                                <td class="px-3 py-2 border border-gray-700">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 border border-gray-700">{{ $product->stok }}</td>
                                <td class="px-3 py-2 border border-gray-700">Rp {{ number_format($product->earning_negosiator, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 border border-gray-700">Rp {{ number_format($product->earning_marketing, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit"
                class="fixed bottom-6 right-6 w-11 h-11 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-700 text-2xl font-bold">
                +
            </button>
        </form>

        {{-- Form Marketing Earning --}}
        <div class="mt-12">
            <h2 class="text-base font-semibold mb-4">Data Marketing Earning</h2>

            @if (session('marketing_success'))
                <div class="bg-green-700 text-white p-3 mb-4 rounded shadow">
                    {{ session('marketing_success') }}
                </div>
            @endif

            <form id="marketing-form" action="{{ route('marketing.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-gray-800 p-6 rounded-lg shadow max-w-xl mx-auto">
                @csrf

                @foreach ([
                    ['label' => 'Nama Marketing', 'name' => 'nama', 'type' => 'text'],
                    ['label' => 'Nomor Telepon', 'name' => 'nomor_telp', 'type' => 'text'],
                    ['label' => 'Nama Produk', 'name' => 'nama_produk', 'type' => 'text'],
                    ['label' => 'Earning', 'name' => 'earning', 'type' => 'number'],
                    ['label' => 'Hari & Tanggal', 'name' => 'hari_tanggal', 'type' => 'text'],
                    ['label' => 'Gambar', 'name' => 'gambar', 'type' => 'file']
                ] as $field)
                    <div>
                        <label class="block mb-1 text-sm font-medium">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}"
                            name="{{ $field['name'] }}"
                            class="w-full p-2 bg-gray-900 text-white border border-gray-600 rounded shadow-inner focus:ring focus:ring-blue-500"
                            {{ $field['type'] !== 'file' ? 'required' : '' }}
                            {{ isset($field['readonly']) ? 'readonly' : '' }}
                            value="{{ $field['value'] ?? '' }}">
                    </div>
                @endforeach

                {{-- Kode Earning (Tersembunyi) --}}
                <div id="code-container" class="hidden">
                    <label class="block mb-1 text-sm font-medium">Kode Earning</label>
                    <input type="text" name="code_earning" id="code_earning"
                        class="w-full p-2 bg-gray-900 text-white border border-gray-600 rounded shadow-inner" readonly>
                </div>

                <div class="flex justify-end space-x-2 pt-4">
                    <button type="button" id="generate-code"
                        class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 shadow">
                        Generate Code
                    </button>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 shadow">
                        Simpan Marketing
                    </button>
                </div>
            </form>
        </div>

        {{-- Script Generate Kode --}}
        <script>
            document.getElementById('generate-code').addEventListener('click', function () {
                const form = document.getElementById('marketing-form');
                const inputs = form.querySelectorAll('input:not([type="file"]):not(#code_earning)');
                let allFilled = true;

                inputs.forEach(function (input) {
                    if (!input.value.trim()) {
                        allFilled = false;
                        input.classList.add('border-red-500'); // beri tanda merah
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                if (!allFilled) {
                    alert('Silakan isi semua field terlebih dahulu sebelum generate kode.');
                    return;
                }

                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let code = 'EARN-';
                for (let i = 0; i < 8; i++) {
                    code += characters.charAt(Math.floor(Math.random() * characters.length));
                }

                document.getElementById('code_earning').value = code;
                document.getElementById('code-container').classList.remove('hidden');
            });
        </script>

    </div>
</x-app-layout>
