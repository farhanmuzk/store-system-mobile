<x-app-layout class="relative">
    <div class="relative flex items-center justify-center py-12">
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-chevron-left" width="24" height="24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg">
            Notification
        </button>
    </div>

    @foreach ($notifications as $notification)
        @php
            $status = $notification->status;
            \Carbon\Carbon::setLocale('id');
            $carbonTime = \Carbon\Carbon::parse($notification->notification_time);
            $formattedDate = $carbonTime->translatedFormat('H:i - l, d, n, Y');

            $productLine = '';
            $noted = $notification->noted ?? $notification->text;
            $notedPlus = $notification->noted_plus;

            if (preg_match('/Product:\s*([^,]+)/', $noted, $matches)) {
                $productName = $matches[1];
                $productLine = 'Product: ' . $productName . ' : ' . $notedPlus;
            }
        @endphp

        <div class="relative flex flex-col justify-center px-4 py-4 w-full notification-item cursor-pointer rounded-lg mt-4 bg-gray-800 shadow-md transition-colors duration-300"
            data-status="{{ $status }}">

            {{-- Tombol Bukti hanya jika ada image --}}
            @if ($notification->image)
                <div class="absolute top-4 right-4">
                    <button onclick="showModal('{{ Storage::url($notification->image) }}')"
                        class="text-sm font-semibold px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                        Bukti
                    </button>
                </div>
            @endif

            <p class="text-lg text-white mt-2">
                {{ $formattedDate }}
            </p>

            <a class="text-lg font-bold mt-2 px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg hover:bg-gray-600">
                {{ $productLine }}
            </a>

            <div class="flex justify-between mt-4 bukti-section hidden {{ $status !== 'pending' ? 'pointer-events-none opacity-50' : '' }}">
                <form action="{{ route('notifications.reject', $notification) }}" method="POST"
                    class="rounded-lg p-2 bg-red-500">
                    @csrf
                    <button type="submit" class="text-white">Reject</button>
                </form>

                <form action="{{ route('notifications.approve', $notification) }}" method="POST"
                    class="rounded-lg p-2 bg-green-500">
                    @csrf
                    <button type="submit" class="text-white">Approve</button>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Modal Gambar (Letakkan di luar @foreach) --}}
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-md w-full relative">
            <button onclick="closeModal()"
                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600">
                ✕
            </button>
            <img id="modalImage" src="" alt="Bukti Gambar" class="w-full h-auto rounded-b-lg">
        </div>
    </div>

        <script>
            function showModal(imageUrl) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageUrl;
                modal.classList.remove('hidden');
            }

            function closeModal() {
                const modal = document.getElementById('imageModal');
                modal.classList.add('hidden');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = '';
            }
        </script>
</x-app-layout>
