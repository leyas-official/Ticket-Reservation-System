<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Events</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <x-admin-sidebar></x-admin-sidebar>
    <div class="flex-1 p-10 mt-16">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold">Events</h2>
            <a href=" {{ route('admin.events.create') }}" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded transition duration-200 font-semibold">Add Event</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-100 border border-gray-200 rounded-md">
                <thead>
                    <tr class="bg-gray-700 text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Type</th>
                        <th class="py-3 px-6 text-left">Location</th>
                        <th class="py-3 px-6 text-left">Time</th>
                        <th class="py-3 px-6 text-left">Date</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)

                    <tr class="border-b border-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer">
                        <td class="py-3 px-6">{{ $event->name }}</td>
                        <td class="py-3 px-6 truncate">{{ $event->description }}</td>
                        <td class="py-3 px-6">{{ $event['eventType']['name']}}</td>
                        <td class="py-3 px-6">{{ $event['location']['name']}}</td>
                        <td class="py-3 px-6">{{ $event->time}}</td>
                        <td class="py-3 px-6">{{ $event->date}}</td>
                        <td class="py-3 px-6">{{ $event->price}}</td>
                        <td class="py-3 px-6">
                            <button class="bg-blue-800 text-white py-1 px-3 rounded hover:bg-blue-900  transition duration-200 font-semibold">Edit</button>
                            <button class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 font-semibold">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</body>
</html>
