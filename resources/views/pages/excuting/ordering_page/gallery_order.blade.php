<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Galerry Order
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

                    <div
                        class="rounded-lg text-white border-2 {{ $borderColor }} shadow p-6 hover:shadow-md transition duration-300">

                        <h2 class="text-xl text-center font-semibold">-*UNTUK PEMESANAN*-</h2>

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

                        @if (empty($notification->noted_plus) && empty($notification->image))
                            <form action="{{ route('notifications.updatePlus', $notification) }}" method="POST"
                                enctype="multipart/form-data">

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
                            <div class="mt-4">
                                <label class="block text-sm text-gray-400 mb-1">Catatan Tambahan (noted_plus)</label>
                                <input type="text" name="noted_plus"
                                    class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600"
                                    value="{{ $notification->noted_plus }}" readonly>
                                @if (!empty($notification->image))
                                    <div x-data="{ open: false, edit: false }" class="mt-4 space-y-2">
                                        <div class="flex gap-2">
                                            <button @click="open = true"
                                                class="bg-gray-700 text-white font-semibold px-4 py-2 rounded">
                                                View Image
                                            </button>
                                            <button @click="edit = true"
                                                class="bg-yellow-500 text-white font-semibold px-4 py-2 rounded">
                                                Update
                                            </button>
                                        </div>

                                        <div x-show="open" x-transition
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50">
                                            <div class="bg-white p-4 rounded-lg max-w-lg w-full relative">
                                                <button @click="open = false"
                                                    class="absolute top-2 right-2 text-gray-700 hover:text-black">
                                                    ✖
                                                </button>
                                                <img src="{{ asset('storage/' . $notification->image) }}"
                                                    alt="Uploaded Image" class="w-full rounded">
                                            </div>
                                        </div>

                                        <div x-show="edit" x-transition class="mt-4">
                                            <form action="{{ route('notifications.updatePlus', $notification) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-2">
                                                    <label class="block text-sm text-gray-400 mb-1">Update Catatan
                                                        Tambahan</label>
                                                    <input type="text" name="noted_plus"
                                                        value="{{ $notification->noted_plus }}"
                                                        class="w-full px-3 py-2 rounded bg-gray-800 text-white border border-gray-600">
                                                </div>
                                                <div class="mb-2">
                                                    <label class="block text-sm text-gray-400 mb-1">Update
                                                        Gambar</label>
                                                    <input type="file" name="image"
                                                        class="w-full text-sm text-gray-200">
                                                </div>
                                                <button type="submit"
                                                    class="bg-green-600 hover:bg-green-500 text-white font-semibold px-4 py-2 rounded">
                                                    Simpan Perubahan
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
