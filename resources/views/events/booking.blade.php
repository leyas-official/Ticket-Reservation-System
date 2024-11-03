<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden flex">

        <!-- Ticket Booking Form Section -->
        <div class="w-2/3 p-8 space-y-6 bg-white rounded-lg shadow-md">

            @guest
                <h3 class="block text-3xl font-bold text-blue-800 text-center">Sign In</h3>
                <div class="mt-7 bg-white rounded-xl p-6 ">
                    <!-- Sign In Form -->
                    <form action="{{ route('signIn')}}" method="POST">
                        @csrf
                        <div class="grid gap-y-4">

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm mb-2 text-gray-700">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('email') border-red-600 @enderror" placeholder="you@example.com">
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm mb-2 text-gray-700">Password</label>
                                <input type="password" id="password" name="password" class="py-3 px-4 block w-full border border-gray-300 rounded-lg text-sm focus:border-blue-500 focus:ring focus:ring-blue-300 focus:outline-none @error('password') border-red-600 @enderror" placeholder="Your Password">
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Back Button -->
                            <div class="flex flex-row gap-4">
                                <a href="{{ route('events') }}" class="w-md px-4 py-2 font-semibold text-gray-800 bg-gray-500 rounded-lg hover:bg-gray-800 transition duration-200 text-white">
                                    Back
                                </a>
                                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-700 text-white hover:bg-blue-900 focus:outline-none">Sign In</button>
                            </div>
                        </div>
                    </form>
                    <!-- End Sign Up Form -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">You don't have an account? <a href="{{ route('register')}}" class="text-blue-600 hover:underline">Sign Up</a></p>
                    </div>
                </div>
            @endguest


            @auth
            <h3 class="text-3xl font-bold text-center text-blue-800">Book an Event</h3>
            <form action="{{route('addTicket')}}" method="POST" class="space-y-4">
                @csrf
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-600 @enderror" placeholder="Your Name" value="{{ auth()->user()->name }}">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Email Address</label>
                    <input type="email" name="email" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-600 @enderror" placeholder="you@example.com" value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div>
                    <label class="block text-sm font-medium text-gray-600">Payment Method</label>
                    <select name="payment_method" required class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_method') border-red-600 @enderror">
                        <option value="DebtCard">Debt Card</option>
                        <option value="Sadad">Sadad</option>
                        <option value="Idfali">Idfa' li</option>
                        <option value="MobyCash">Moby Cash</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="eventId" value="{{ $event->id }}">
                <input type="hidden" name="userId" value="{{ auth()->user()->id }}">


                <div class="flex flex-row gap-4">
                    <a href="{{ route('events') }}" class="w-md px-4 py-2 font-semibold text-gray-800 bg-gray-300 rounded-lg hover:bg-gray-400 transition duration-200">
                        Back
                    </a>
                    <!-- Submit Button -->
                    <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-800 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-700 transition duration-200">
                        Confirm Booking
                    </button>
                </div>
            </form>
            @endauth
        </div>

        <!-- Event Details Sidebar Section -->
        <div class="w-1/3 p-8 space-y-6 bg-gray-50 rounded-r-lg shadow-lg flex flex-col items-center justify-center pb-24">
            <h2 class="text-4xl font-bold text-center text-blue-800 mb-4">{{ $event->name }}</h2>
            <div class="space-y-2 text-center">
                <p class="text-sm text-gray-600">📍 Location: <span class="font-medium text-gray-800">{{ $event->location->name }}</span></p>
                <p class="text-sm text-gray-600">📅 Date: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('F d, Y') }}</span></p>
                <p class="text-sm text-gray-600">⏰ Time: <span class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</span></p>
            </div>
            <p class="text-gray-700 leading-relaxed mt-6">{{ $event->description }}</p>
        </div>
    </div>
</body>
</html>
