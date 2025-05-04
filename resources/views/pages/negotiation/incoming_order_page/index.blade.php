<x-app-layout class="relative bg-gray-900 text-white min-h-screen">
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
            Incoming Order
        </button>
    </div>
    <div class="flex space-x-4 justify-center items-center px-4 mb-6">
        <a href="/incoming-notification" class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-bell">
                <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                <path
                    d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
            </svg>
        </a>
        <a href="/history-notification" class="text-lg font-bold px-8 py-3 bg-gray-700 text-white rounded-lg shadow-lg focus:outline-none">
            History Order
        </a>
    </div>

    <div class="max-w-2xl mx-auto px-6 pb-12">
        <div x-data="{ paymentMethod: '{{ old('payment_method', $incomingOrder->payment_method ?? '') }}' }">
            <form method="POST"
                action="{{ $incomingOrder ? route('pages.negotiation.incoming_order_page.edit', ['order' => $incomingOrder->id]) : route('pages.negotiation.incoming_order_page.store') }}"
                class="space-y-5 bg-gray-800 p-6 rounded-xl shadow-md">
                @csrf
                @if ($incomingOrder)
                    @method('PUT')
                @endif

                @foreach ([
                    'product' => 'Product Name',
                    'quantity' => 'Quantity',
                    'customer_name' => 'Customer Name',
                    'address' => 'Address',
                    'rt_rw' => 'RT/RW',
                    'district' => 'District',
                    'regency' => 'Regency',
                    'province' => 'Province',
                    'phone_number' => 'Phone Number',
                    'total' => 'Total Payment',
                ] as $field => $placeholder)
                    <input type="{{ $field === 'quantity' || $field === 'total' ? 'number' : 'text' }}"
                        name="{{ $field }}" required
                        class="w-full p-3 bg-gray-900 text-white border border-gray-700 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        value="{{ old($field, $incomingOrder->$field ?? '') }}" placeholder="{{ $placeholder }}">
                @endforeach

                {{-- Select Payment Method --}}
                <select name="payment_method" id="payment_method" x-model="paymentMethod"
                    class="w-full p-3 bg-gray-900 text-white border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">Select Payment Method</option>
                    <option value="Transfer (Dana)">Transfer (Dana)</option>
                    <option value="Transfer (Gopay)">Transfer (Gopay)</option>
                    <option value="Cash">Cash</option>
                </select>

                {{-- Nomor Transfer --}}
                <div x-show="paymentMethod === 'Transfer (Dana)' || paymentMethod === 'Transfer (Gopay)'" x-transition>
                    <input type="text" name="nomor_tf"
                        class="w-full mt-3 p-3 bg-gray-900 text-white border border-gray-700 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                        placeholder="Nomor Transfer" value="{{ old('nomor_tf', $incomingOrder->nomor_tf ?? '') }}">
                </div>

                {{-- Estimation (nullable) --}}
                <input type="text" name="estimation"
                    class="w-full p-3 bg-gray-900 text-white border border-gray-700 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="{{ old('estimation', $incomingOrder->estimation ?? '') }}"
                    placeholder="Estimation (optional)">

                {{-- Note (nullable) --}}
                <textarea name="note" rows="3"
                    class="w-full p-3 bg-gray-900 text-white border border-gray-700 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Note (optional)">{{ old('note', $incomingOrder->note ?? '') }}</textarea>

                <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-300">
                    {{ $incomingOrder ? 'Update Data' : 'Submit' }}
                </button>
            </form>
        </div>
    </div>

    @if ($notification)
        <div x-data="{
            show: localStorage.getItem('modal_closed_{{ $notification->id }}') !== 'true',
            closeModal() {
                this.show = false;
                localStorage.setItem('modal_closed_{{ $notification->id }}', 'true');
            }
        }" x-show="show" x-transition
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50 p-5">
            <div
                class="bg-gray-900 text-white p-6 rounded-xl shadow-xl max-w-md w-full text-center space-y-4 border border-gray-700">
                @if ($notification->status === 'pending')
                    <p class="text-lg font-semibold">Menunggu Approve admin...</p>
                @elseif ($notification->status === 'approved')
                    <p class="text-lg font-semibold">✅ Data Approved</p>
                    <button @click="closeModal()"
                        class="mt-4 px-4 py-2 bg-green-600 hover:bg-green-500 text-white rounded-lg transition">
                        ✕ Close
                    </button>
                @elseif ($notification->status === 'rejected')
                    <div>
                        <h2 class="text-xl font-bold text-red-500 mb-2">Your request was rejected</h2>
                        <p class="text-sm text-gray-300 mb-2">You can update and resubmit the form below.</p>
                        <div class="bg-gray-800 border border-red-500 p-3 rounded text-sm text-white">
                            <strong>Note:</strong> {{ $notification->noted }}
                        </div>
                        <div class="mt-4">
                            <button
                                @click="closeModal(); $nextTick(() => window.dispatchEvent(new Event('close-modal'))) "
                                class="bg-red-600 hover:bg-red-500 px-4 py-2 text-white rounded-lg transition">
                                ✕ Close
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <script src="//unpkg.com/alpinejs" defer></script>
</x-app-layout>
