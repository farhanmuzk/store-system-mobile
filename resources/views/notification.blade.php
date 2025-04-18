<x-app-layout class="relative">
    <div class="relative flex items-center justify-center py-12">
        <a href="/dashboard"
           class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-chevron-left" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"/>
            </svg>
        </a>

        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg">
            Notification
        </button>
    </div>

    @foreach ($notifications as $notification)
        @php
            $status = $notification->status;
            $bgColor = match ($status) {
                'approved' => 'bg-green-600',
                'rejected' => 'bg-red-700',
                default => 'bg-gray-700',
            };
        @endphp

        <div class="flex flex-col justify-center px-4 py-4 w-full notification-item cursor-pointer rounded-lg mt-4 transition-colors duration-300"
             data-image="{{ Storage::url($notification->image) }}"
             data-text="{{ $notification->noted ?? $notification->text }}"
             data-status="{{ $status }}">

            <p class="text-lg text-white">
                {{ \Carbon\Carbon::parse($notification->notification_time)->format('d F - H:i') }}
            </p>

            <a class="text-lg font-bold px-8 py-3 {{ $bgColor }} text-white rounded-lg shadow-lg hover:bg-gray-600">
                {{ $notification->noted ?? $notification->text }}
            </a>

            <div class="flex justify-between mt-4 bukti-section hidden {{ $status !== 'pending' ? 'pointer-events-none opacity-50' : '' }}">
                <form action="{{ route('notifications.reject', $notification) }}" method="POST"
                      class="rounded-lg p-2 bg-red-500">
                    @csrf
                    <button type="submit" class="text-white">
                        Reject
                    </button>
                </form>

                <form action="{{ route('notifications.approve', $notification) }}" method="POST"
                      class="rounded-lg p-2 bg-green-500">
                    @csrf
                    <button type="submit" class="text-white">
                        Approve
                    </button>
                </form>
            </div>
        </div>
    @endforeach

    <div id="buktiButton"
         class="fixed bottom-[50%] right-0 flex items-center justify-center w-16 h-16 bg-gray-700 text-white rounded-lg border-2 border-white shadow-lg hover:bg-gray-600 focus:outline-none cursor-pointer">
        <p class="text-center" id="buktiText">Bukti</p>
    </div>

    {{-- Modal Image / Noted --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg max-w-lg relative">
            <img id="modalImage" src="" class="max-w-full h-auto rounded-lg hidden">
            <div id="notedContent" class="text-white hidden"></div>
            <button id="closeModal" class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full">✖</button>
        </div>
    </div>

    {{-- Script --}}
    <script>
        // Toggle Bukti Section
        document.getElementById('buktiButton').addEventListener('click', function () {
            const buktiSections = document.querySelectorAll('.bukti-section');
            const buktiText = document.getElementById('buktiText');

            buktiSections.forEach(section => {
                const parent = section.closest('.notification-item');
                const status = parent.getAttribute('data-status');

                // hanya toggle jika pending
                if (status === 'pending') {
                    section.classList.toggle('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });

            const anyVisible = Array.from(buktiSections).some(section => !section.classList.contains('hidden'));

            buktiText.innerHTML = anyVisible ? `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>` : 'Bukti';
        });

        // Modal Image/Noted Viewer
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const notedContent = document.getElementById('notedContent');
        const closeModal = document.getElementById('closeModal');

        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', (e) => {
                // Jangan buka modal kalau klik tombol/form
                if (e.target.closest('form') || e.target.tagName === 'BUTTON') return;

                const image = item.getAttribute('data-image');
                const text = item.getAttribute('data-text');

                if (image && !image.endsWith('/')) {
                    modalImage.src = image;
                    modalImage.classList.remove('hidden');
                    notedContent.classList.add('hidden');
                } else {
                    modalImage.classList.add('hidden');
                    notedContent.classList.remove('hidden');
                    notedContent.textContent = text;
                }

                modal.classList.remove('hidden');
            });
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>
</x-app-layout>
