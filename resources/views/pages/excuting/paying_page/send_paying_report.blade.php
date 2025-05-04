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
            <form id="reportForm" action="{{ route('send-paying-report.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Upload Gambar -->
                    <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 text-white">
                        <h2 class="text-xl font-semibold mb-4">Section One</h2>

                        <!-- Area Dropzone -->
                        <div id="dropzone"
                            onclick="document.getElementById('imageInput').click();"
                            class="w-full h-48 flex items-center justify-center bg-gray-700 rounded-lg border-2 border-dashed border-gray-500 cursor-pointer hover:border-white transition mb-4">
                            <span class="text-gray-300 text-sm">Click or drag an image here</span>
                        </div>

                        <!-- Preview Image -->
                        <div id="imagePreview" class="mb-4 hidden">
                            <span class="text-gray-400 text-sm">No image selected</span>
                        </div>

                        <input type="file" id="imageInput" name="file" accept="image/*" class="hidden" onchange="previewImage(event)">
                        <input type="hidden" name="type_report" value="paying">

                        <!-- Tombol Submit -->
                        <div id="submitBtnContainer" class="hidden">
                            <button type="submit"
                                class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-gray-600">
                                Send Report
                            </button>
                        </div>
                    </div>
                </div>
            </form>


            <!-- Baris kedua -->
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200">
                <!-- Judul -->
                <h2 class="text-xl font-semibold mb-4 text-white">Notif Earning</h2>

                <!-- Daftar Notifikasi -->
                <div class="space-y-3 mb-6">
                    @forelse ($reports as $report)
                    @if (!empty($report->teks))
                        <div class="gap-3 p-3 bg-gray-100 rounded-lg">
                            <p class="text-gray-700 text-sm">
                                {{ $report->teks }}
                            </p>
                        </div>
                    @endif
                @empty
                    <p class="text-gray-400">No earning reports yet.</p>
                @endforelse

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
            const dropzone = document.getElementById('dropzone');
            const submitBtnContainer = document.getElementById('submitBtnContainer');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Tampilkan gambar
                    preview.innerHTML = `<img src="${e.target.result}" class="w-full max-h-48 object-contain rounded-lg" />`;

                    // Tampilkan preview, sembunyikan dropzone
                    preview.classList.remove('hidden');
                    dropzone.classList.add('hidden');
                    submitBtnContainer.classList.remove('hidden');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Reset ke awal
                preview.innerHTML = `<span class="text-gray-400 text-sm">No image selected</span>`;
                preview.classList.add('hidden');
                dropzone.classList.remove('hidden');
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
