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
            Ordering Report
        </button>
    </div>

    <!-- Konten Utama -->
    <div class="px-8 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Kolom Notif Earning -->
            <div class="bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200">
                <h2 class="text-xl text-center font-semibold mb-4 text-white">Notif Earning</h2>

                @foreach($reports as $report)
                @if(empty($report->teks))
                    <div onclick="showImageModal('{{ asset('storage/' . $report->file) }}')" class="cursor-pointer">
                        <div class="relative">
                            <div
                                class="w-full flex items-center justify-between bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200 mb-2">
                                {{ $report->label }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    class="lucide lucide-folder-down">
                                    <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z" />
                                    <path d="M12 10v6" />
                                    <path d="m15 13-3 3-3-3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

            </div>

            <!-- Form Update Teks -->
            <form method="POST" action="{{ route('paying-report.update') }}" class="bg-gray-800 rounded-xl shadow-md p-6 mt-4 text-white">
                @csrf

                <!-- Dropdown Pilih Report -->
                <label for="report_id" class="block mb-2 font-semibold">Pilih Report untuk Diperbarui</label>
                <select name="report_id" id="report_id" class="w-full mb-4 rounded-md text-black px-4 py-2">
                    @foreach($reports as $report)
                        @if($report->type_report === 'paying' && empty($report->teks))
                            <option value="{{ $report->id }}" {{ $loop->first ? 'selected' : '' }}>
                                {{ $report->label }}
                            </option>
                        @endif
                    @endforeach
                </select>


                <!-- Textarea -->
                <label for="teks" class="block mb-2 font-semibold">Isi Pesan</label>
                <textarea name="teks" id="teks" rows="4" class="w-full rounded-md mb-4 text-black px-4 py-2">
{{ $reports->first()->teks ?? '' }}
                </textarea>

                <!-- Tombol Kirim -->
                <button
                    class="w-full bg-emerald-600 text-white font-semibold py-2 px-4 rounded-lg shadow hover:bg-emerald-500 transition duration-200">
                    Kirim
                </button>
            </form>

            <!-- Modal Gambar -->
            <div id="imageModal"
                 class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white rounded-lg overflow-hidden shadow-xl">
                    <img id="modalImage" src="" alt="Report Image" class="max-w-full max-h-screen">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function showImageModal(imageUrl) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    document.getElementById('imageModal').addEventListener('click', function () {
        this.classList.add('hidden');
        this.classList.remove('flex');
    });
</script>
