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
            History Notification
        </button>
    </div>
    <div class="py-10 px-4 max-w-5xl mx-auto relative">
        @if ($notifications->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 px-6 py-4 rounded-lg shadow">
                Tidak ada notifikasi yang tersedia.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($notifications->where('status', 'approved') as $notification)
                    @php
                        $borderColor = match ($notification->status) {
                            'approved' => 'border-green-500',
                            'rejected' => 'border-red-500',
                            default => 'border-yellow-400',
                        };
                    @endphp

                    <div x-data="{ openUserModal: false }" class="flex justify-center mt-2">
                        <div @click="openUserModal = true"
                            class="cursor-pointer w-[60px] h-[60px] rounded-full bg-gray-700 overflow-hidden flex items-center justify-center">
                            <img src="https://i.pinimg.com/736x/1d/ec/e2/1dece2c8357bdd7cee3b15036344faf5.jpg"
                                alt="" class="w-full h-full object-cover rounded-full">
                        </div>

                        <div x-show="openUserModal" x-transition
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative text-gray-800">
                                <button @click="openUserModal = false"
                                    class="absolute top-2 right-2 text-gray-700 hover:text-black">
                                    ✖
                                </button>
                                <h2 class="text-lg font-bold mb-2">User Info</h2>
                                <p><strong>Name:</strong> {{ $notification->user->name ?? '-' }}</p>
                                <p><strong>Email:</strong> {{ $notification->user->email ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div x-data="{ open: false }" @click="open = true"
                        class="cursor-pointer rounded-lg text-white border-2 {{ $borderColor }} shadow p-6 hover:shadow-md transition duration-300">



                        {{-- STATUS --}}
                        <h2 class="text-xl text-center font-semibold">-*UNTUK PEMESANAN*-</h2>

                        {{-- NOTED --}}
                        <div class="mt-4">

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
                        @if (empty($notification->noted_plus) && empty($notification->image))
                            <h2 class="text-lg mt-2 text-red-500 text-center font-semibold"> Data status belum tersedia <br>
                                <span class="text-white text-sm text-center">Segera hubungi admin</span>
                            </h2>
                        @else
                            <div class="mt-4">
                                <label class="block text-sm text-gray-400 mb-1">Catatan Tambahan
                                    (noted_plus)
                                </label>
                                <input type="text" name="noted_plus"
                                    class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600"
                                    placeholder="Tambahkan catatan tambahan..." value="{{ $notification->noted_plus }}"
                                    readonly>
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
                                        $productLine = 'Nama Produk : ' . $productName;
                                    }

                                    $statusLine = 'Status : ' . ucfirst($notedPlus);
                                @endphp

                                @if (!empty($notification->image))
                                    <div x-show="open" x-transition
                                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-70 z-50">
                                        <div
                                            class="bg-white p-6 rounded-xl shadow-xl max-w-xl w-full relative space-y-4">
                                            <button @click.stop="open = false"
                                                class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl font-bold">
                                                ✖
                                            </button>

                                            <!-- Informasi -->
                                            <div class="text-gray-800 space-y-1">
                                                <p class="text-base font-semibold">{{ $productLine }}</p>
                                                <p class="text-sm text-gray-600">{{ $statusLine }}</p>
                                            </div>

                                            <!-- Gambar -->
                                            <img src="{{ asset('storage/' . $notification->image) }}"
                                                alt="Uploaded Image"
                                                class="w-full rounded-lg border border-gray-200 shadow">
                                        </div>
                                    </div>
                                @endif


                            </div>
                        @endif
                    </div>
                @endforeach

                {{-- Modal untuk View Image --}}


                {{-- MODAL INFO USER --}}


            </div>
        @endif
    </div>

</x-app-layout>
