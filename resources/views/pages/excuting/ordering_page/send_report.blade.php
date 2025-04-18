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

        <!-- Tombol Send Report -->
        <button
            class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none hover:bg-gray-600">
            Send Report
        </button>
    </div>

    <!-- Konten Utama dengan 2 Kolom 50/50 -->
    <div class="px-8 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Baris pertama -->
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 cursor-pointer relative group"
                onclick="document.getElementById('imageInput').click()">
                <h2 class="text-white text-xl font-semibold mb-4">Section One</h2>
                <p class="text-white mb-4">Click here to upload an image.</p>

                <!-- Tempat Preview Gambar -->
                <div id="imagePreview"
                    class="w-full aspect-video bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                    <span class="text-gray-400 text-sm">No image selected</span>
                </div>

                <!-- Tombol Kirim (disembunyikan dulu) -->
                <div id="submitBtnContainer" class="mt-4 hidden">
                    <button
                        class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-500 transition duration-200"
                        onclick="submitImage()">
                        Send Image
                    </button>
                </div>

                <!-- Input Gambar Disembunyikan -->
                <input type="file" accept="image/*" id="imageInput" class="hidden" onchange="previewImage(event)" />
                <button
                    class="w-full bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mt-2">
                    Kirim
                </button>
            </div>

            <!-- Baris kedua -->
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200">
                <!-- Judul -->
                <h2 class="text-xl font-semibold mb-4 text-white">Notif Earning</h2>

                <!-- Daftar Notifikasi -->
                <div class="space-y-3 mb-6">
                    <div class="gap-3 p-3 bg-gray-100 rounded-lg">
                        <p class="text-gray-700 text-sm">Your earn <span class="text-green-600 font-medium">+ Rp200.000</span> (code 74567)</p>
                    </div>
                </div>

                <!-- Tombol Bayar -->
                <button
                    class="w-full bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200">
                    Bayaran nya
                </button>
            </div>

        </div>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('imagePreview');
            const submitBtnContainer = document.getElementById('submitBtnContainer');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.innerHTML =
                        `<img src="${e.target.result}" class="w-full h-full object-cover rounded-lg" />`;
                    submitBtnContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.innerHTML = `<span class="text-gray-400 text-sm">No image selected</span>`;
                submitBtnContainer.classList.add('hidden');
            }
        }

        function submitImage() {
            const fileInput = document.getElementById('imageInput');
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];

                // Simulasi kirim file - kamu bisa ganti ini dengan FormData & fetch/ajax
                alert(`Image "${file.name}" will be sent!`);

                // Reset tampilan setelah kirim
                document.getElementById('imagePreview').innerHTML =
                    `<span class="text-gray-400 text-sm">No image selected</span>`;
                document.getElementById('submitBtnContainer').classList.add('hidden');
                fileInput.value = ""; // Reset input
            }
        }
    </script>
</x-app-layout>
