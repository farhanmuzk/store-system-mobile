<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <a href="javascript:history.back()"
           class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </a>

        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Negotiation
        </button>
    </div>

    <div class="flex flex-col items-center justify-center px-4">
        <img src="https://i.pinimg.com/736x/29/58/2a/29582a5c7fd453f8c6acbbe458c07ae2.jpg"
             alt="Negotiation"
             class="w-full max-w-3xl rounded-lg shadow-lg mt-4">
    </div>

    <div class="flex md:justify-center gap-4 mt-8 px-2 w-full">
        <!-- Berat -->
        <div class="rounded-xl shadow-md p-2 flex-1 flex flex-col items-center">
            <h2 class="text-center font-semibold mb-3 text-white text-sm">Berat Barang</h2>
            <div class="flex flex-col space-y-2 w-full">
                <button onclick="selectOption('weight', '1 Kg')" class="option-btn" data-type="weight" data-value="1 Kg">1 Kg</button>
                <button onclick="selectOption('weight', '2 Kg')" class="option-btn" data-type="weight" data-value="2 Kg">2 Kg</button>
                <button onclick="selectOption('weight', '3 Kg')" class="option-btn" data-type="weight" data-value="3 Kg">3 Kg</button>
            </div>
        </div>
        <!-- Metode Bayar -->
        <div class="rounded-xl shadow-md p-2 flex-1 flex flex-col items-center min-w-[40px]">
            <h2 class="font-semibold mb-3 text-white text-center text-sm">Metode Bayar</h2>
            <div class="flex flex-col space-y-2 w-full">
                <button onclick="selectOption('payment', 'COD')" class="option-btn" data-type="payment" data-value="COD">COD</button>
                <button onclick="selectOption('payment', 'TF')" class="option-btn" data-type="payment" data-value="TF">TF</button>
            </div>
        </div>
        <!-- Provinsi -->
        <div class="rounded-xl shadow-md p-2 flex-1 flex flex-col items-center min-w-[40px]">
            <h2 class="font-semibold mb-3 text-white text-center text-sm">Provinsi</h2>
            <div class="flex flex-col space-y-2 w-full">
                <button onclick="selectOption('province', 'Jawa Barat')" class="option-btn" data-type="province" data-value="Jawa Barat">Jawa Barat</button>
                <button onclick="selectOption('province', 'Jawa Tengah')" class="option-btn" data-type="province" data-value="Jawa Tengah">Jawa Tengah</button>
                <button onclick="selectOption('province', 'Jawa Timur')" class="option-btn" data-type="province" data-value="Jawa Timur">Jawa Timur</button>
            </div>
        </div>
    </div>

    <!-- Hasil Estimasi -->
    <div class="mt-8 px-3">
        <div class="rounded-lg shadow-md max-w-md mx-auto bg-white p-4">
            <h3 class="text-sm font-bold text-left mb-2">Cek Estimasi</h3>
            <div class="flex justify-around text-center text-xs bg-white py-2 rounded shadow">
                <div>
                    <p class="text-gray-500">Harga</p>
                    <p id="price" class="font-semibold text-gray-800 text-sm">-</p>
                </div>
                <div>
                    <p class="text-gray-500">Nama Jasa</p>
                    <p id="service" class="font-semibold text-gray-800 text-sm">-</p>
                </div>
                <div>
                    <p class="text-gray-500">Estimasi</p>
                    <p id="estimate" class="font-semibold text-gray-800 text-sm">-</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        const selected = { weight: null, payment: null, province: null };

        function selectOption(type, value) {
            selected[type] = value;

            // Remove previous active button
            document.querySelectorAll(`.option-btn[data-type="${type}"]`).forEach(btn => {
                btn.classList.remove('active-option');
            });

            // Add active to current selection
            const selectedBtn = document.querySelector(`.option-btn[data-type="${type}"][data-value="${value}"]`);
            if (selectedBtn) selectedBtn.classList.add('active-option');

            // Fetch data only when all options are selected
            if (selected.weight && selected.payment && selected.province) {
                fetch('/data_estimation.json')
                    .then(res => res.json())
                    .then(data => {
                        const result = data.find(item =>
                            item.berat === selected.weight &&
                            item.bayar === selected.payment &&
                            item.provinsi === selected.province
                        );
                        if (result) {
                            document.getElementById('price').innerText = result.harga;
                            document.getElementById('service').innerText = result.jasa;
                            document.getElementById('estimate').innerText = result.estimasi;
                        } else {
                            document.getElementById('price').innerText = '-';
                            document.getElementById('service').innerText = '-';
                            document.getElementById('estimate').innerText = '-';
                        }
                    });
            }
        }
    </script>

    <!-- Style -->
    <style>
        .option-btn {
            width: 100%;
            padding: 0.375rem 0.5rem;
            font-size: 0.875rem;
            background-color: #374151;
            color: white;
            border-radius: 0.5rem;
            transition: background 0.2s;
        }

        .option-btn:hover {
            background-color: #4b5563;
        }

        .option-btn.active-option {
            background-color: #10b981;
            color: white;
            font-weight: bold;
            border: 2px solid #059669;
        }
    </style>
</x-app-layout>
