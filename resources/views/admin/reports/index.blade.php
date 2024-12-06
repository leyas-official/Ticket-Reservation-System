<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">

<x-admin-sidebar></x-admin-sidebar>
<!-- Main Content -->
<div class="flex-1 p-10 ml-56">
    <h2 class="text-3xl font-semibold">Monthly Report</h2>
    <p class="mt-4 text-gray-600">View the key statistics and reports for the selected month.</p>
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <form method="GET" action="{{ route('admin.reports') }}">
            <input type="month" id="month" name="month" value="{{ request('month', now()->format('Y-m')) }}"
                   class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="submit" class="mt-2 p-2 bg-blue-500 text-white rounded-md">Filter</button>
        </form>

    </div>

    <!-- Reports Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Events</h3>
            <p class="text-2xl font-bold">{{ count($events) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Tickets Sold</h3>
            <p class="text-2xl font-bold">{{ count($tickets) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">New Customers</h3>
            <p class="text-2xl font-bold">{{ count($customers) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Revenue</h3>
            <p class="text-2xl font-bold text-green-600">{{ number_format($total, 2) }} USD</p>
        </div>
    </div>

    <!-- Download Button & Table -->
    <div class="mt-10">
        <div class="flex justify-end mb-4">
            <a href="{{ route('downloadReport') }}" onclick="alert('Are You Sure To Download Report This Month ?')" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 shadow-md">Download Report</a>

        </div>
        <h3 class="text-xl font-semibold">Detailed Reports</h3>
        <!-- Wrapping div with scroll for long tables -->
        <div class="max-h-[500px] overflow-y-auto border border-gray-300 rounded-md">
            <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md">
                <thead>
                <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Event Name</th>
                    <th class="py-3 px-6 text-center">Event Date</th>
                    <th class="py-3 px-6 text-center">Tickets Sold</th>
                </tr>
                </thead>
                <tbody>
                @php $totalTicketsSold = 0; @endphp
                @foreach ($events as $event)
                    @php $ticketsSold = $tickets->where('eventId', $event->id)->count(); @endphp
                    @php $totalTicketsSold += $ticketsSold; @endphp
                    <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                        <td class="py-3 px-6 truncate text-center">{{ $event->name }}</td>
                        <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</td>
                        <td class="py-3 px-6 text-center">{{ $ticketsSold }}</td>
                    </tr>
                @endforeach

                <!-- Additional rows for testing scrolling -->
                <tr class="font-bold bg-gray-200">
                    <td colspan="2" class="py-3 px-6 text-right">Total Tickets Sold</td>
                    <td class="py-3 px-6 text-center">{{ $totalTicketsSold }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
