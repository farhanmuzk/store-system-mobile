    <x-app-layout>
        <div class="relative flex items-center justify-center py-12">
            <a href="/ordering"
                class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-left">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </a>

            <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
                Notification Order
            </button>
        </div>
        <div class="py-10 px-4 max-w-5xl mx-auto relative">
            @if ($notifications->isEmpty())
                <div class="bg-yellow-100 text-yellow-800 px-6 py-4 rounded-lg shadow">
                    Tidak ada notifikasi yang tersedia.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($notifications as $notification)
                        @php
                            $borderColor = match ($notification->status) {
                                'approved' => 'border-green-500',
                                'rejected' => 'border-red-500',
                                default => 'border-yellow-400',
                            };
                        @endphp

                        <div
                            class="rounded-lg text-white border-2 {{ $borderColor }} shadow p-6 hover:shadow-md transition duration-300">


                            {{-- STATUS --}}
                            <h2 class="text-xl text-center font-semibold">-*UNTUK PEMESANAN*-</h2>
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <span class="text-sm font-medium text-gray-500">Status:</span>
                                    <span
                                        class="px-3 rounded-full text-sm font-semibold
                                        {{ $notification->status === 'approved'
                                            ? ' text-green-500'
                                            : ($notification->status === 'rejected'
                                                ? ' text-red-500'
                                                : ' text-yellow-500') }}">
                                        {{ ucfirst($notification->status) }}
                                    </span>
                                </div>
                                <div class="text-right text-xs text-gray-400">
                                    Dibuat pada:
                                    <span class="font-semibold text-white text-xs">
                                        {{ $notification->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>

                            {{-- NOTED --}}
                            <div class="mt-4 relative">
                                @if ($notification->status === 'approved' || $notification->status === 'rejected')
                                    <div
                                        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10
                                        w-32 h-32 flex items-center justify-center text-center text-xl font-bold
                                        rounded-full rotate-[-15deg] bg-opacity-20
                                        {{ $notification->status === 'approved' ? 'text-green-600 border-green-600 bg-green-200' : 'text-red-600 border-red-600 bg-red-200' }}
                                        border-4">
                                        {{ strtoupper($notification->status) }}
                                    </div>
                                @endif

                                <div class="rounded-lg text-white text-sm overflow-x-auto">
                                    @php
                                        $notedData = [];
                                        if ($notification->noted) {
                                            $pairs = explode(',', $notification->noted);
                                            foreach ($pairs as $pair) {
                                                $keyValue = explode(':', $pair, 2);
                                                if (count($keyValue) === 2) {
                                                    $notedData[] = [
                                                        'key' => trim($keyValue[0]),
                                                        'value' => trim($keyValue[1]),
                                                    ];
                                                }
                                            }
                                        }
                                    @endphp

                                    @if (count($notedData))
                                        <table class="w-full text-sm text-left">
                                            @foreach ($notedData as $item)
                                                <tr class="align-top pb-2">
                                                    <td class="pr-2 font-semibold text-gray-400 whitespace-nowrap">
                                                        {{ $item['key'] }}:</td>
                                                    <td class="text-white">{{ $item['value'] }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <div class="text-center my-10">
                                            <p class="text-red-500">No data available</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- FORM UNTUK NOTED_PLUS SEBELUM MENENTUKAN STATUS --}}
                            @if ($notification->status === 'pending')
                                @if (empty($notification->noted_plus) && empty($notification->image))
                                    <form action="{{ route('notifications.updatePlus', $notification) }}" method="POST"
                                        enctype="multipart/form-data" class="mt-4 space-y-4">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label class="block text-sm text-gray-400 mb-1">Catatan Tambahan
                                                (noted_plus)
                                            </label>
                                            <input type="text" name="noted_plus"
                                                class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600"
                                                placeholder="Tambahkan catatan tambahan...">
                                        </div>
                                        <div>
                                            <label class="block text-sm text-gray-400 mb-1">Upload Gambar</label>
                                            <input type="file" name="image" class="w-full text-sm text-gray-200">
                                        </div>
                                        <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-4 py-2 rounded">
                                            Simpan Noted Plus
                                        </button>
                                    </form>
                                @else
                                    <div class="mt-4 text-center text-green-500 bg-green-100 px-4 py-2 rounded">
                                        Catatan tambahan dan gambar telah terkirim.
                                    </div>
                                @endif
                            @endif


                            @if ($notification->status === 'pending')
                                {{-- TOMBOL APPROVE & REJECT --}}
                                <div class="mt-6 flex justify-between items-center space-x-4">
                                    <form action="{{ route('notifications.approve', $notification) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg">Approve</button>
                                    </form>

                                    <button type="button"
                                        onclick="document.getElementById('reject-form-{{ $loop->index }}').classList.toggle('hidden')"
                                        class="bg-red-600 hover:bg-red-500 text-white px-4 py-2 rounded-lg">Reject</button>
                                </div>

                                {{-- FORM NOTED UNTUK REJECT --}}
                                <form id="reject-form-{{ $loop->index }}"
                                    action="{{ route('notifications.reject', $notification) }}" method="POST"
                                    class="mt-4 hidden">
                                    @csrf
                                    @method('PUT')
                                    <label class="block text-sm text-gray-400 mb-1">Alasan Penolakan (Noted)</label>
                                    <textarea name="noted" rows="3" class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600"
                                        placeholder="Tulis alasan penolakan..."></textarea>
                                    <button type="submit"
                                        class="mt-2 bg-red-700 hover:bg-red-600 text-white px-4 py-2 rounded">Kirim
                                        Penolakan</button>
                                </form>
                            @endif


                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Tombol di kiri bawah -->
            <a href="/gallery-order"
                class="fixed bottom-4 left-4 z-50 bg-gray-700 hover:bg-gray-600 text-center  text-white font-semibold px-4 py-2 rounded-lg shadow-lg">
                Galeri Pesanan
            </a>

            <a href="/send-report"
                class="fixed bottom-4 right-4 z-50 bg-gray-700 hover:bg-gray-600 text-center text-white font-semibold px-4 py-2 rounded-lg shadow-lg">
                Kirim Laporan
            </a>


        </div>
    </x-app-layout>
