<x-layout>
    <x-slot:head>
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Step 1: Choose Payment Method</h1>
        </div>
    </x-slot:head>

    <div class="flex items-center justify-center">
        <div class="w-full max-w-4xl p-10 bg-white rounded-lg shadow-md">
            <form id="paymentForm" action="#" method="get">
                @csrf
                <!-- Subtitle - "Choose Payment Method" -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Choose Payment Method</h2>

                <!-- Payment Method Selection -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <!-- Option 1 -->
                    <label class="cursor-pointer group flex justify-center">
                        <input type="radio" name="payment" value="sdad" class="hidden peer" required>
                        <img src="{{ asset('images/sdad.png') }}" alt="Sdad"
                             class="w-32 h-32 object-contain border-4 border-gray-300 rounded-lg group-hover:border-blue-500 transition transform group-hover:scale-110 peer-focus:border-blue-500 peer-checked:border-blue-600">
                    </label>

                    <!-- Option 2 -->
                    <label class="cursor-pointer group flex justify-center">
                        <input type="radio" name="payment" value="edf3li" class="hidden peer" required>
                        <img src="{{ asset('images/edf3li.png') }}" alt="Edf3li"
                             class="w-32 h-32 object-contain border-4 border-gray-300 rounded-lg group-hover:border-blue-500 transition transform group-hover:scale-110 peer-focus:border-blue-500 peer-checked:border-blue-600">
                    </label>

                    <!-- Option 3 -->
                    <label class="cursor-pointer group flex justify-center">
                        <input type="radio" name="payment" value="mobicash" class="hidden peer" required>
                        <img src="{{ asset('images/mobicash.png') }}" alt="MobiCash"
                             class="w-32 h-32 object-contain border-4 border-gray-300 rounded-lg group-hover:border-blue-500 transition transform group-hover:scale-110 peer-focus:border-blue-500 peer-checked:border-blue-600">
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center">
                    <!-- Back Button -->
                    <a href="{{ route('myCart') }}"
                       class="px-6 py-3 bg-gray-400 text-white rounded-lg font-medium transition transform hover:bg-gray-500 hover:scale-105">
                        Back
                    </a>

                    <!-- Next Step Button -->
                    <button type="submit"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium transition transform hover:bg-blue-700 hover:scale-105">
                        Next Step
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener('submit', function (event) {
            const selectedPayment = document.querySelector('input[name="payment"]:checked');
            if (selectedPayment) {
                let action = '';
                switch (selectedPayment.value) {
                    case 'sdad':
                        action = '{{ route('payments', [$ticket->id, 'Sadad']) }}'; // Example route for "Sdad"
                        break;
                    case 'edf3li':
                        action = '{{ route('payments', [$ticket->id, 'Edf3li']) }}'; // Example route for "Edf3li"
                        break;
                    case 'mobicash':
                        action = '{{ route('payments', [$ticket->id, 'MobiCash']) }}'; // Example route for "MobiCash"
                        break;
                    default:
                        action = '#'; // Default action if no payment method is selected
                }
                paymentForm.action = action;
            } else {
                event.preventDefault(); // Prevent form submission if no payment method is selected
                // alert("Please select a payment method.");
            }
        });
    </script>
</x-layout>
