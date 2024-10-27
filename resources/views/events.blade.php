<x-layout>
    <x-slot:head>
        Available Events
    </x-slot:head>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-300 bg-gray-800">
            <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                <tr>
                    <th scope="col" class="px-10 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-10 py-3">
                        Color
                    </th>
                    <th scope="col" class="px-10 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-10 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-10 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-gray-900 odd:dark:bg-gray-800 even:bg-gray-800 even:dark:bg-gray-700 border-b border-gray-600">
                    <th scope="row" class="px-10 py-7 font-medium text-yellow-400 whitespace-nowrap dark:text-yellow-300">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-10 py-7 text-gray-400">
                        Silver
                    </td>
                    <td class="px-10 py-7 text-gray-400">
                        Laptop
                    </td>
                    <td class="px-10 py-7 text-gray-400">
                        $2999
                    </td>
                    <td class="px-10 py-7">
                        <a href="#" class="font-medium text-yellow-500 hover:text-yellow-300 hover:underline">Booking</a>
                    </td>
                </tr>
                <tr class="odd:bg-gray-900 odd:dark:bg-gray-800 even:bg-gray-800 even:dark:bg-gray-700 border-b border-gray-600">
                    <th scope="row" class="px-10 py-7 font-medium text-yellow-400 whitespace-nowrap dark:text-yellow-300">
                        Microsoft Surface Pro
                    </th>
                    <td class="px-10 py-7 text-gray-400">
                        White
                    </td>
                    <td class="px-10 py-7 text-gray-400">
                        Laptop PC
                    </td>
                    <td class="px-10 py-7 text-gray-400">
                        $1999
                    </td>
                    <td class="px-10 py-7">
                        <a href="#" class="font-medium text-yellow-500 hover:text-yellow-300 hover:underline">Booking</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>
