<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Details</title>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
<div class="p-8 bg-white border border-gray-300 rounded-xl shadow-lg w-96"> <!-- Larger padding, width, and border styling -->
    <!-- Event Name -->
    <h2 class="text-2xl font-bold text-blue-900 text-center">{{ $customer['name'] }}</h2>

    <!-- Ticket Details -->
    <div class="mt-8 space-y-6"> <!-- Increased spacing for clearer separation -->

        <!-- Customer No -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                    Customer No :
                </span>
            <span class="font-semibold text-gray-700">{{ $customer['id'] }}</span>
        </div>

        <!-- Customer Email -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>

                    Email :
                </span>
            <span class="font-semibold text-gray-700">{{ $customer['email']  }} </span>
        </div>

        <!-- Ticket Status -->
        <div class="flex justify-between items-center">
                <span class="flex items-center text-gray-600 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 mr-2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Starts On :
                </span>
            <span class="font-semibold text-gray-700 text-sm"> {{ \Carbon\Carbon::parse($customer['created_at'])->format('F j, Y, g:i A') }} </span>
        </div>
    </div>

    <!-- Back Button -->
    <div class="mt-8 text-center">
        <a href="{{ route('admin.customers') }}" class="inline-block py-2 px-6 bg-gray-300 text-white font-semibold rounded-lg hover:bg-gray-400 transition duration-300 ease-in-out shadow-md">
            Back
        </a>
    </div>
</div>
</body>
</html>
