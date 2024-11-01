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
    <h4 class="block text-3xl font-bold text-red-500 text-center">Ticket Information</h4>
    <!-- Sign Up Form -->
    <form action="{{ route('ticketCancel')}}" method="POST">
        @csrf
        <div class="grid gap-y-4">
            <!-- Full Name -->
            <div>
                <p>Event Name : {{$ticket->event->name}}</p>
            </div>

            <!-- Email -->
            <div>
                Payment Method : {{$ticket->paymentType}}
            </div>

            <!-- Password -->
            <div>

            </div>


            <!-- Confirm Password -->
            <div>

            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none transition duration-200">Cancel Reservation</button>
        </div>
    </form>

</div>
</body>
</html>
