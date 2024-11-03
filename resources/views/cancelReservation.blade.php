<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up</title>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
<div class="mt-7 bg-white rounded-xl p-6 shadow-lg w-full max-w-md">
    <h4 class="block text-3xl font-bold text-red-500 text-center">Cancel Reservation</h4>

    <form action="{{ route('ticketCancel') }}" method="POST">
        @csrf
        <div class="bg-white p-6 rounded-lg shadow-md">  <!-- Added container for better visual separation -->
            <p class="text-lg mb-4 text-center">Are you sure you want to cancel this reservation?</p>  <!-- Increased font size and added margin -->

            <div class="flex justify-between">
                <a href="{{ route('userTickets') }}" class="text-center w-1/2 px-4 py-3 font-semibold text-white bg-gray-500 rounded-lg hover:bg-gray-700 focus:bg-gray-800 transition duration-200 mr-2">  <!-- Added w-1/2 and margin -->
                    Cancel
                </a>
                <button type="submit" class="w-1/2 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-200 ml-2">  <!-- Added w-1/2 and margin -->
                    Yes
                </button>
            </div>
        </div>
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
    </form>

</div>
</body>
</html>
