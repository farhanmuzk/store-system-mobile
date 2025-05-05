<x-app-layout>
    <div class="relative flex items-center justify-center py-12">
        <!-- Button Icon di Kiri -->
        <a href="javascript:history.back()"
            class="absolute left-4 flex items-center justify-center w-10 h-10 bg-gray-700 text-white rounded-full shadow-lg hover:bg-gray-600 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-chevron-left">
                <path d="m15 18-6-6 6-6" />
            </svg>
        </a>

        <!-- Button Marketing di Tengah -->
        <button class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            Paying Member
        </button>
    </div>

    <div class="relative" x-data="{ showModal: false }">
        <!-- Tombol Riwayat di kanan atas -->
        <a href="/riwayat"
            class="absolute top-4 right-4 px-4 py-2 bg-gray-700 text-white rounded-md shadow hover:bg-gray-600">
            Riwayat
        </a>

        <!-- Container Chat -->
        @foreach ($notifications as $item)
            @if ($item->image)
                <div x-data="{ showModal: false }">
                    <!-- Trigger -->
                    <div class="flex flex-col py-2 px-4 max-w-xl mx-auto">
                        <div class="space-y-1 cursor-pointer" @click="showModal = true">
                            <div class="text-left text-sm text-gray-500">ID: {{ $item->id }}</div>
                            <div class="flex items-start space-x-3">
                                <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                                    class="w-10 h-10 rounded-full object-cover" alt="User">
                                <div class="bg-gray-200 text-gray-900 px-4 py-2 rounded-xl max-w-[80%]">
                                    {{ $item->noted ?? 'Payment Notification' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div x-show="showModal" x-cloak
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
                        <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg max-w-md w-full relative">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Preview"
                                class="w-full h-64 object-cover">

                            <div class="flex justify-between px-6 py-4 space-x-2">
                                <!-- ACC Form -->
                                <form action="{{ route('notifications.approve', $item->id) }}" method="POST"
                                    class="w-1/2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-green-600 text-white hover:bg-green-500 rounded-md">
                                        ACC
                                    </button>
                                </form>

                                <!-- Reject Form -->
                                <form action="{{ route('notifications.reject', $item->id) }}" method="POST"
                                    class="w-1/2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-red-600 text-white hover:bg-red-500 rounded-md">
                                        Reject
                                    </button>
                                </form>
                            </div>

                            <!-- Close Modal -->
                            <button @click="showModal = false"
                                class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white text-sm w-8 h-8 flex items-center justify-center rounded-full transition">
                                x
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach


        

    </div>
</x-app-layout>
