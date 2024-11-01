<x-layout>
    <x-slot:head>
        <h1 class="text-3xl font-bold text-blue-900 text-center">Reserved Tickets</h1>
    </x-slot:head>
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
{{--                @foreach($userTickets as $tickets)--}}
                    <tr class="bg-gray-500  border-b border-gray-600 transition-all duration-300  hover:shadow-lg">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-100 whitespace-nowrap text-center">
                            Apple MacBook Pro 17
                        </th>
                        <td class="px-6 py-4 text-gray-200 text-center">
                            Silver
                        </td>
                        <td class="px-6 py-4 text-gray-200 text-center">
                            Laptop
                        </td>
                        <td class="px-6 py-4 text-gray-200 text-center">
                            معرض طرابلس الدولي
                        </td>
                        <td class="px-6 py-4 flex justify-center text-center">
                            <a href="#" class="font-medium text-white px-3 py-1 bg-red-600 hover:bg-red-700 rounded-2xl transition-all duration-300 ml-2.5 mr-2.5">Delete</a>
                        </td>
                    </tr>
{{--                @endforeach--}}
            </tbody>
        </table>
    </div>
</x-layout>
