<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Tickets </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <x-admin-sidebar></x-admin-sidebar>
    <div class="flex-1 p-10 mt-16 ml-56">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Our Tickets</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md">
                <thead>
                <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">Customer Name</th>
                    <th class="py-3 px-6 text-center">Event Name</th>
                    <th class="py-3 px-6 text-center">Price</th>
                    <th class="py-3 px-6 text-center">Event Time</th>
                    <th class="py-3 px-6 text-center">Event Date</th>
                    <th class="py-3 px-6 text-center">Payment Method</th>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                        <td class="py-3 px-6 truncate text-center">{{ $ticket['user']['name'] }}</td>
                        <td class="py-3 px-6 truncate text-center">{{ $ticket['event']['name'] }}</td>
                        <td class="py-3 px-6 text-center">{{ $ticket['event']['price']}} $</td>
                        <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($ticket['event']['time'])->format('h:i A') }}</td>
                        <td class="py-3 px-6 text-center">{{ \Carbon\Carbon::parse($ticket['event']['date'])->format('F j, Y') }}</td>
                        <td class="py-3 px-6 text-center">{{ $ticket->paymentType }} </td>
                        <td class="px-6 py-4 flex justify-center text-center gap-4">
                            <a href="{{  route('admin.tickets.show' , $ticket->id) }}" class="bg-yellow-400 text-white py-1 px-3 rounded hover:bg-yellow-600 transition duration-10 00 font-semibold">Show Details</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
