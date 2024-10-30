<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Event Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Book an Event</h2>
        <form action="/book-event" method="POST" class="space-y-4">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-600">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-800" placeholder="Your Name">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-600">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-800" placeholder="you@example.com">
            </div>

            <!-- Booking Date -->
            <div>
                <label class="block text-sm font-medium text-gray-600">Booking Date</label>
                <input type="date" name="booking_date" required class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-800">
            </div>

            <!-- Number of Tickets -->
            <div>
                <label class="block text-sm font-medium text-gray-600">Number of Tickets</label>
                <input type="number" name="tickets" required min="1" class="w-full px-4 py-2 mt-1 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-800" placeholder="1">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full px-4 py-2 font-semibold text-white bg-blue-800 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring focus:bg-blue-700">
                    Confirm Booking
                </button>
            </div>
        </form>
    </div>
</body>
</html>
