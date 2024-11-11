<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">

    <x-admin-sidebar></x-admin-sidebar>
        <!-- Main Content -->
        <div class="flex-1 p-10 ml-56">
            <h2 class="text-3xl font-semibold">Welcome Admin {{ Auth::user()->name }} To Your Dashboard</h2>
            <p class="mt-4 text-gray-600">Here you can manage your application effectively.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">Total Events</h3>
                    <p class="text-2xl font-bold">{{ count($events) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">Tickets Booking</h3>
                    <p class="text-2xl font-bold">{{ count($tickets) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">Total Customers</h3>
                    <p class="text-2xl font-bold">{{ count($customers) }}</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
