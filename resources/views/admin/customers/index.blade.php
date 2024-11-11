<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Customers </title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<x-admin-sidebar></x-admin-sidebar>
<div class="flex-1 p-10 mt-16 ml-56">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Our Customers</h2>
    </div>
    @if(session('success'))
        <div id="success-message" class="relative mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-lg">
            <button onclick="document.getElementById('success-message').style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900 focus:outline-none text-lg">
                &times;
            </button>
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto ">
        <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md">
            <thead>
            <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-center">Customer No.</th>
                <th class="py-3 px-6 text-center">Customer Name</th>
                <th class="py-3 px-6 text-center">Customer Email</th>
                <th class="py-3 px-6 text-center">Started On</th>
                <th class="py-3 px-6 text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)
                <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                    <td class="py-3 px-6 truncate text-center">{{ $customer['id'] }}</td>
                    <td class="py-3 px-6 truncate text-center">{{ $customer['name'] }}</td>
                    <td class="py-3 px-6 truncate text-center">{{ $customer['email'] }}</td>
                    <td class="py-3 px-6 truncate text-center">{{ \Carbon\Carbon::parse($customer['created_at'])->format('F j, Y, g:i A') }}</td>
                    <td class="px-6 py-4 flex justify-center text-center gap-4">
                        <a href="{{  route('admin.customers.show' , $customer->id) }}" class="bg-yellow-400 text-white py-1 px-3 rounded hover:bg-yellow-600 transition duration-10 00 font-semibold">Show Details</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
