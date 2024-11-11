<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ticket Details</title>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
<div class="p-8 bg-white border border-gray-300 rounded-xl shadow-lg w-96"> <!-- Larger padding, width, and border styling -->
    <!-- Event Name -->
    <h2 class="text-2xl font-bold text-blue-900 text-center">{{ $ticket['event']['name'] ?? 'Event Name' }}</h2>

    <!-- Ticket Details -->
    <div class="mt-8 space-y-6"> <!-- Increased spacing for clearer separation -->

        <!-- User Name -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    User :
                </span>
            <span class="font-semibold text-gray-700">{{ $ticket['user']['name'] ?? 'User Name' }}</span>
        </div>

        <!-- Payment Type -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Payment Type :
                </span>
            <span class="font-semibold text-gray-700">{{ $ticket['paymentType'] ?? 'Payment Type' }}</span>
        </div>

        <!-- Ticket price -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2 text-yellow-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Price :
                </span>
            <span class="font-semibold text-gray-700">{{ $ticket['event']['price'] ?? 'Status' }} $</span>
        </div>

        <!-- Ticket Status -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                    </svg>
                    Status :
                </span>
            <span class="font-semibold text-gray-700">{{ $ticket['ticketStatus'] ?? 'Status' }}</span>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('admin.tickets') }}" class="inline-block py-2 px-6 bg-gray-300 text-white font-semibold rounded-lg hover:bg-gray-400 transition duration-300 ease-in-out shadow-md">
            Back
        </a>
    </div>
</div>
</body>
</html>
