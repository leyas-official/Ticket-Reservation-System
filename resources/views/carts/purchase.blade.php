@php
    use App\Enums\ticketStatus;
@endphp

<x-layout>
    <x-slot:head>
        <!-- Header -->
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Complete Purchase</h1>
        </div>
    </x-slot:head>


        <div class="w-full max-w-lg p-8 bg-white rounded-lg shadow-md w-auto">
            <!-- Title -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Purchase Ticket</h2>
            <p class="text-sm text-gray-500 mb-8">
                Please provide your details below to complete the purchase.
            </p>

            <!-- Purchase Ticket Form -->
            <form action="#" method="POST" class="space-y-6">
                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input id="name" name="name" type="text" placeholder="Enter your full name"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input id="email" name="email" type="email" placeholder="Enter your email address"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Ticket Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Ticket Quantity</label>
                    <input id="quantity" name="quantity" type="number" min="1" placeholder="Enter ticket quantity"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                </div>

                <!-- Payment Method -->
                <div>
                    <label for="payment" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <select id="payment" name="payment"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Select payment method</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="mobicash">MobiCash</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between items-center">
                    <a href="{{ route('myCart') }}" type="button"
                            class="px-6 py-2 bg-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                        Purchase Ticket
                    </button>
                </div>
            </form>
        </div>

</x-layout>
