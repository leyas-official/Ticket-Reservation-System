<x-layout>
    <x-slot:head>
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Purchased Tickets</h1>
        </div>
    </x-slot:head>

    @guest()
        <div class="flex text-center h-screen justify-center flex-col">
            <h3>You must sign in to view your Purchased Tickets</h3>
            <a href="{{ route('login') }}" class="relative inline-block px-6 py-2 rounded-full bg-blue-950 text-sm font-medium text-white transition duration-300 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 mt-4">  <!-- Changes here -->
                Login
            </a>
        </div>
    @endguest

    @auth()
        @if(empty($userTickets))
            <div class="flex text-center h-screen justify-center flex-col">
                <h3>You Have no Purchased Tickets</h3>
                <a href="{{ route('events') }}" class="relative inline-block px-6 py-2 rounded-full bg-blue-950 text-sm font-medium text-white transition duration-300 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 mt-4">  <!-- Changes here -->
                    Booking
                </a>
            </div>
        @else
        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right bg-blue-900 rounded-lg text-white">
                <thead class="text-xs text-white uppercase bg-gray-700 rounded-t-lg">
                    <tr>
                        <th scope="col" class="px-6 py-4 border-b border-gray-600 text-center">
                            Event Name
                        </th>
                        <th scope="col" class="px-6 py-4 border-b border-gray-600 text-center">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-4 border-b border-gray-600 text-center">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-4 border-b border-gray-600 text-center">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-4 border-b border-gray-600 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userTickets as $ticket)
                        <tr class="bg-gray-500  border-b border-gray-600 transition-all duration-300  hover:shadow-lg">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-100 whitespace-nowrap text-center">
                                {{$ticket->event->name}}
                            </th>
                            <td class="px-6 py-4 text-gray-200 text-center">
                                {{$ticket->event->date}}
                            </td>
                            <td class="px-6 py-4 text-gray-200 text-center">
                                {{$ticket->event->date}}
                            </td>
                            <td class="px-6 py-4 text-gray-200 text-center">
                                {{$ticket->event->location->name}}
                            </td>
                            <td class="px-6 py-4 flex justify-center text-center">
                                <a href="{{ route('cancelReservation', ['eventTicket' => $ticket]) }}" class="font-medium text-white px-3 py-1 bg-red-600 hover:bg-red-700 rounded-2xl transition-all duration-300 ml-2.5 mr-2.5">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    @endauth
</x-layout>
