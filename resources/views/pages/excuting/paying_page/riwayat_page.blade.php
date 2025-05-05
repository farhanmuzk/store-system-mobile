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
            Riwayat
        </button>
    </div>

    <div x-data="{ selectedFilter: '{{ request()->get('status', 'pending') }}', showOptions: false }">
        <!-- Dropdown Filter -->
        <div class="relative w-[300px] mx-auto mb-4">
            <button @click="showOptions = !showOptions"
                class="w-full flex items-center justify-between text-lg font-bold px-6 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
                <span x-text="selectedFilter === 'pending' ? 'Perlu Diperiksa' : 'Sudah Dibayar'"></span>
                <svg class="ml-2 w-4 h-4 transform transition-transform duration-200"
                    :class="{ 'rotate-180': showOptions }" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="showOptions" @click.outside="showOptions = false"
                class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-10">
                <ul>
                    <li @click="selectedFilter = 'pending'; window.location.href='?status=pending'"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Perlu Dibayar</li>
                    <li @click="selectedFilter = 'approved'; window.location.href='?status=approved'"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Sudah Dibayar</li>
                </ul>
            </div>
        </div>

        <!-- Konten berdasarkan filter -->
        <div class="flex flex-col py-2 px-4 max-w-xl mx-auto">
            <template x-if="selectedFilter === 'pending'">
                @foreach ($notifications as $item)
                    <div x-data="{ showModal: false, selectedImage: '' }">
                        <!-- Trigger -->
                        <div class="space-y-1 cursor-pointer"
                            @click="showModal = true; selectedImage = '{{ asset('storage/' . $item->image) }}'">
                            <div class="text-left text-sm text-gray-500">{{ $item->created_at->format('d F Y - H:i') }}
                            </div>
                            <div class="flex items-start space-x-3">
                                <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                                    class="w-10 h-10 rounded-full object-cover" alt="User">
                                <div class="bg-yellow-100 text-yellow-900 px-4 py-2 rounded-xl max-w-[80%]">
                                    Marketing: {{ $item->user->name }}
                                    <br> <span>Status: Perlu Diperiksa</span>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="showModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
                            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg max-w-md w-full relative">
                                <img :src="selectedImage" alt="Preview" class="w-full h-64 object-cover">



                                <!-- Close Modal -->
                                <button @click="showModal = false"
                                    class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white text-sm w-8 h-8 flex items-center justify-center rounded-full transition">
                                    x
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </template>

            <template x-if="selectedFilter === 'approved'">
                @foreach ($notifications as $item)
                    <div x-data="{ showModal: false, selectedImage: '' }">
                        <!-- Trigger -->
                        <div class="space-y-1 cursor-pointer"
                            @click="showModal = true; selectedImage = '{{ asset('storage/' . $item->image) }}'">
                            <div class="text-left text-sm text-gray-500">{{ $item->created_at->format('d F Y - H:i') }}
                            </div>
                            <div class="flex items-start space-x-3">
                                <img src="https://i.pinimg.com/736x/39/2b/76/392b76c3b2ecf525946e59b64d22823f.jpg"
                                    class="w-10 h-10 rounded-full object-cover" alt="User">
                                <div class="bg-red-100 text-red-900 px-4 py-2 rounded-xl max-w-[80%]">
                                    Marketing: {{ $item->user->name }}
                                    <br> <span>Status: Sudah Dibayar</span>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="showModal" x-cloak
                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-6">
                            <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg max-w-md w-full relative">
                                <img :src="selectedImage" alt="Preview" class="w-full h-64 object-cover">



                                <!-- Close Modal -->
                                <button @click="showModal = false"
                                    class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white text-sm w-8 h-8 flex items-center justify-center rounded-full transition">
                                    x
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </template>
        </div>
    </div>
</x-app-layout>
