<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <div class="max-w-lg mx-auto mt-10 bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800">Add New Event</h2>
        <form action="#" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-gray-700 font-semibold">Event Title</label>
                <input type="text" id="title" name="title" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter event title">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-semibold">Event Description</label>
                <textarea id="description" name="description" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Enter event description"></textarea>
            </div>

            <div>
                <label for="date" class="block text-gray-700 font-semibold">Event Date</label>
                <input type="date" id="date" name="date" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="time" class="block text-gray-700 font-semibold">Event Time</label>
                <input type="time" id="time" name="time" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="location" class="block text-gray-700 font-semibold">Event Location</label>
                <select id="location" name="location" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Select a location</option>
                    @foreach($locations as $location) <!-- Assuming you have a variable $locations -->
                        <option value="{{ $location->id }}">
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="location" class="block text-gray-700 font-semibold">Event Type </label>
                <select id="location" name="location" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>Select a location</option>
                    @foreach($types as $type) <!-- Assuming you have a variable $locations -->
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="capacity" class="block text-gray-700 font-semibold">Capacity</label>
                <input type="number" id="capacity" name="capacity" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter maximum capacity">
            </div>

            <div class="flex flex-row gap-4">
                <a href="{{ route('admin.events') }} " type="submit" class="w-16 text-center bg-gray-400 text-white font-semibold py-2 rounded hover:bg-gray-400 transition duration-300">Back</a>
                <button type="submit" class="w-full bg-blue-800 text-white font-semibold py-2 rounded hover:bg-blue-900 transition duration-300">Add Event</button>
            </div>
        </form>
    </div>

</body>
</html>
