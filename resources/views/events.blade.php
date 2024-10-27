<x-layout>
    <x-slot:head>
        Available Events
    </x-slot:head>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-10 py-7 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-10 py-7">
                        Silver
                    </td>
                    <td class="px-10 py-7">
                        Laptop
                    </td>
                    <td class="px-10 py-7">
                        $2999
                    </td>
                    <td class="px-10 py-7">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-10 py-7 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Microsoft Surface Pro
                    </th>
                    <td class="px-10 py-7">
                        White
                    </td>
                    <td class="px-10 py-7">
                        Laptop PC
                    </td>
                    <td class="px-10 py-7">
                        $1999
                    </td>
                    <td class="px-10 py-7">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layout>