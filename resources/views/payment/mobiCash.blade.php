<x-layout>
    <x-slot:head>
        <div class="w-full bg-white shadow-lg rounded-lg p-6 mb-8 mx-4 flex items-center justify-between">
            <h1 class="text-3xl font-semibold text-green-900">Step 2: Welcome to MobiCash Gateway</h1>
        </div>
    </x-slot:head>

    <section class="py-8 antialiased md:py-16 bg-gray-50 rounded-md shadow-lg">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-5xl">
                <!-- Logo and Heading Section -->
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-semibold text-green-800 sm:text-3xl h-auto">Payment</h2>
                    <img src="{{ asset('images/mobicash.png') }}" alt="Ticket System Logo" class="w-32 h-auto rounded-lg">
                </div>

                <!-- Payment Form Section -->
                <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 flex flex-row justify-center items-center">
                    <form id="payment-form" action="{{ route('mobiCash.process' , $ticket->id) }}" method="POST" class="w-full p-6 shadow-md sm:p-8 lg:max-w-xl lg:p-10 space-y-6 bg-white rounded-lg border border-gray-200">
                        @csrf

                        <!-- Card Number -->
                        <div class="flex flex-col">
                            <label for="email" class="mb-2 text-sm font-medium text-gray-800 font-semibold">
                                Your Email in Mobi Cash*
                            </label>
                            <input type="email" id="email" name="email"
                                   class="w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900
                                    focus:border-green-500 focus:ring-2 focus:ring-green-400 @error('email') border-red-500 @enderror"
                                   placeholder="something@mobi.com" />
                            @error('email')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- National ID -->
                        <div class="flex flex-col">
                            <label for="phoneNumber" class="mb-2 text-sm font-medium text-gray-800 font-semibold">
                            Phone Number *
                            </label>
                            <input type="text" id="phoneNumber" name="phoneNumber"
                                   class="w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900
                                    focus:border-green-500 focus:ring-2 focus:ring-green-400 @error('phoneNumber') border-red-500 @enderror"
                                   placeholder="09XXXXXXXX" />
                            @error('phoneNumber')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Discount Type Dropdown -->
                        <div class="flex flex-col">
                            <label for="discount_type" class="mb-2 text-sm font-medium text-gray-900 font-semibold">
                                Discount Type*
                            </label>
                            <select id="discount_type" name="discountType"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 p-3 text-sm text-gray-900
    focus:border-amber-500 focus:ring-2 focus:ring-amber-500 @error('discountType') border-red-500 @enderror"
                                    required>
                                <option value="" disabled selected>Select Discount Type</option>
                                <option value="none">No Discount</option> <!-- خيار جديد بدون خصم -->
                                <option value="seniors">Seniors (20% Off)</option>
                                <option value="students">Students (10% Off)</option>
                                <option value="military">Military (15% Off)</option>
                            </select>
                            @error('discountType')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons Section -->
                        <div class="flex justify-between flex-col gap-4">
                            <button type="submit" class="w-full px-6 py-3 bg-green-700 text-white font-semibold rounded-lg hover:bg-green-800 transition duration-300 focus:ring-4 focus:ring-green-300">
                                Pay Now
                            </button>
                            <a href="{{ route('myCart.purchase', $ticket->id) }}" class="w-full px-6 py-3 text-center bg-gray-400 text-white font-medium rounded-lg hover:bg-gray-500 transition duration-300">
                                Back
                            </a>
                        </div>
                    </form>

                    <!-- Price Summary Section -->
                    <div class="mt-6 lg:mt-0 lg:ml-12 flex-1 space-y-6 rounded-lg border border-gray-100 bg-white p-6">
                        <div class="space-y-4">
                            <dl class="flex justify-between items-center gap-4">
                                <dt class="text-base font-medium text-gray-500">Original Price</dt>
                                <dd class="text-base font-semibold text-gray-900" id="original-price">{{ $ticket->event->price }}$</dd>
                            </dl>

                            <dl class="flex justify-between items-center gap-4">
                                <dt class="text-base font-medium text-gray-500">Savings</dt>
                                <dd class="text-base font-semibold text-green-500" id="savings">-$0.00</dd>
                            </dl>
                        </div>

                        <dl class="flex justify-between items-center gap-4 border-t border-gray-300 pt-6">
                            <dt class="text-xl font-semibold text-gray-900">Total</dt>
                            <dd class="text-xl font-semibold text-gray-900" id="total-price">${{ $ticket->event->price }}</dd>
                        </dl>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        const originalPrice = parseFloat(document.getElementById('original-price').innerText.replace('$', ''));

        document.getElementById('discount_type').addEventListener('change', function() {
            const discountType = this.value;
            let discount = 0;

            if (discountType === 'students') {
                discount = 0.1;
            } else if (discountType === 'military') {
                discount = 0.15;
            } else if (discountType === 'seniors') {
                discount = 0.2;
            } else if (discountType === 'none') {
                discount = 0;
            }

            const totalPrice = originalPrice * (1 - discount);
            document.getElementById('total-price').innerText = `$${totalPrice.toFixed(2)}`;
            document.getElementById('savings').innerText = `-$${(originalPrice * discount).toFixed(2)}`;
        });

    </script>
</x-layout>