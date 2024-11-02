<x-layout>
    <x-slot:head>
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Purchased Tickets</h1>
        </div>
    </x-slot:head>

    @guest()
        <div class="flex flex-col items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
                <h3 class="text-3xl font-bold text-blue-800 mb-4">Welcome!</h3>
                <p class="text-gray-600 mb-6">To view your purchased tickets, please sign in to your account.</p>
                <a href="{{ route('login') }}" class="bg-blue-800 hover:bg-blue-900 transition duration-300 text-white font-semibold py-3 px-6 rounded-lg shadow">
                    Sign In
                </a>
            </div>
        </div>
    @endguest

    @auth()
        @if(count($userTickets) == 0)
            <div class="flex text-center h-screen justify-center flex-col">
                <h3>You Have no Purchased Tickets</h3>
                <a href="{{ route('events') }}" class="relative inline-block px-6 py-2 rounded-full bg-blue-950 text-sm font-medium text-white transition duration-300 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 mt-4">  <!-- Changes here -->
                    Booking
                </a>
            </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md">
                <thead>
                    <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Ticket No.</th>
                        <th class="py-3 px-6 text-left">Event Name</th>
                        <th class="py-3 px-6 text-left">Event Description</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Event Time</th>
                        <th class="py-3 px-6 text-left">Event Date</th>
                        <th class="py-3 px-6 text-left">Payment Method</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userTickets as $ticket)
                    <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                        <td class="py-3 px-6">{{ $ticket->id }}</td>
                        <td class="py-3 px-6 truncate">{{ $ticket['event']['name'] }}</td>
                        <td class="py-3 px-6 truncate  max-w-40 hover:max-w-60 transition-all duration-300">{{ $ticket['event']['description'] }}</td>
                        <td class="py-3 px-6">{{ $ticket['event']['price']}} $</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($ticket['event']['time'])->format('h:i A') }}</td>
                        <td class="py-3 px-6">{{ \Carbon\Carbon::parse($ticket['event']['date'])->format('F j, Y') }}</td>
                        <td class="py-3 px-6">{{ $ticket->paymentType }} </td>
                        <td class="py-3 px-6">
                                {{ $ticket->ticketStatus }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        @endif
    @endauth
</x-layout>
