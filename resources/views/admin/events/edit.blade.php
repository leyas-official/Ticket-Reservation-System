<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Event</title>
</head>
<body class="bg-gray-200">
    <div class="max-w-xl mx-auto mt-16 bg-white rounded-xl shadow-md p-8">
        <h2 class="text-3xl font-extrabold text-center text-green-700 mb-6">Edit Event</h2>
        <form action="{{ route('admin.events.update' , $event->id)}}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-lg font-semibold text-gray-800">Event Name</label>
                <input type="text" id="name" name="name" required
                       class="w-full border @error('name') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                       placeholder="Enter Name Event" value="{{ $event->name }}">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-lg font-semibold text-gray-800">Event Description</label>
                <textarea id="description" name="description" required
                          class="w-full border @error('description') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                          rows="4" placeholder="Provide a brief description of the event...">{{ $event->description }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="date" class="block text-lg font-semibold text-gray-800">Event Date</label>
                    <input type="date" id="date" name="date" required
                           class="w-full border @error('date') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ $event->date }}">
                    @error('date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="endDate" class="block text-lg font-semibold text-gray-800">Event End Date</label>
                    <input type="date" id="endDate" name="endDate" required
                           class="w-full border @error('endDate') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ $event->endDate }}">
                    @error('endDate')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="time" class="block text-lg font-semibold text-gray-800">Event Time</label>
                    <input type="time" id="time" name="time" required
                           class="w-full border @error('time') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ $event->time }}">
                    @error('time')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <label for="location" class="block text-lg font-semibold text-gray-800">Event Location</label>
                <select id="location" name="location" required
                        class="w-full border @error('location') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="" disabled>Select a location</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ $event['location']['id'] == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="type" class="block text-lg font-semibold text-gray-800">Event Type</label>
                <select id="type" name="type" required
                        class="w-full border @error('type') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="" disabled>Select an event type</option>
                        <option value="{{ $event['type']}}" selected>
                            {{ ucfirst($event['type']) }}
                        </option>
                    @if($event['type'] == 'sports')
                        <option value="movies">Movies</option>
                    @endif
                    @if($event['type'] == 'movies')
                        <option value="sports">Sports</option>
                    @endif
                </select>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Additional Fields for Sport -->
            <div id="sport-fields" class="hidden">
                <div>
                    <label for="homeTeam" class="block text-lg font-semibold text-gray-800">Home Team</label>
                    <input type="text" value="@if(!empty($eventType['homeTeam'])){{$eventType['homeTeam']}}@endif" name="homeTeam" id="homeTeam" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Home Team Name">
                </div>
                <div>
                    <label for="awayTeam" class="block text-lg font-semibold text-gray-800">Away Team</label>
                    <input type="text" name="awayTeam" value="@if(!empty($eventType['awayTeam'])){{$eventType['awayTeam']}}@endif" id="awayTeam" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Away Team Name">
                </div>
                <div>
                    <label for="stadium" class="block text-lg font-semibold text-gray-800">Stadium Name</label>
                    <input type="text" name="stadium" value="@if(!empty($eventType['stadium'])){{$eventType['stadium']}}@endif" id="stadium" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Stadium Name">
                </div>
                <div>
                    <label for="typeOfSport" class="block text-lg font-semibold text-gray-800">Type Of Sport</label>
                    <input type="text" name="typeOfSport" value="@if(!empty($eventType['typeOfSport'])){{$eventType['typeOfSport']}}@endif" id="typeOfSport" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Sport Name">
                </div>
            </div>

            <!-- Additional Fields for Movie -->
            <div id="movie-fields" class="hidden">
                <div>
                    <label for="director" class="block text-lg font-semibold text-gray-800">Director Name</label>
                    <input type="text" name="director" value="@if(!empty($eventType['director'])){{$eventType['director']}}@endif" id="director" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Director Name">
                </div>
                <div>
                    <label for="theaterNumber" class="block text-lg font-semibold text-gray-800">Theater Number</label>
                    <input type="text" name="theaterNumber" value="@if(!empty($eventType['theaterNumber'])){{$eventType['theaterNumber']}}@endif" id="theaterNumber" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter Theater Number">
                </div>
                <div>
                    <label for="genre" class="block text-lg font-semibold text-gray-800">Genre</label>
                    <input type="text" name="genre" value="@if(!empty($eventType['genre'])){{$eventType['genre']}}@endif" id="genre" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Romance, Comedy, Etc">
                </div>
                <div>
                    <label for="length" class="block text-lg font-semibold text-gray-800">Length</label>
                    <input type="time" name="length" value="@if(!empty($eventType['length'])){{$eventType['length']}}@endif" id="length" class="w-full border p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>
            </div>

            <script>
                // Listen for change event when the user selects an option
                document.getElementById('type').addEventListener('change', function() {
                    let selectedType = this.value;

                    // Hide all additional fields
                    document.getElementById('sport-fields').classList.add('hidden');
                    document.getElementById('movie-fields').classList.add('hidden');

                    // Show fields based on selected type
                    if (selectedType === 'sports') {
                        document.getElementById('sport-fields').classList.remove('hidden');
                    } else if (selectedType === 'movies') {
                        document.getElementById('movie-fields').classList.remove('hidden');
                    }
                });

                // Trigger the change event on page load to show the relevant fields
                window.addEventListener('load', function() {
                    document.getElementById('type').dispatchEvent(new Event('change'));
                });
            </script>

            <div>
                <label for="price" class="block text-lg font-semibold text-gray-800">Price</label>
                <input type="text" id="price" name="price" required
                       class="w-full border @error('price') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                       placeholder="price.... $" value="{{ $event->price }}">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="numberOfTicket" class="block text-lg font-semibold text-gray-800">Number of Tickets</label>
                <input type="text" id="numberOfTicket" name="numberOfTicket" required
                       class="w-full border @error('numberOfTicket') border-red-500 @else border-gray-300 @enderror p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                       placeholder="e.g., 100 (Max ticket quantity)" value="{{ $event->numberOfTicket }}">
                @error('numberOfTicket')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between gap-4">
                <a href="{{ route('admin.events') }}"
                   class="w-1/3 text-center bg-gray-400 text-white font-semibold py-3 rounded-lg hover:bg-gray-500 transition duration-300">
                    Back
                </a>
                <button type="submit"
                        class="w-2/3 bg-green-600 text-white font-semibold py-3 rounded-lg hover:bg-green-700 transition duration-300">
                    Update Event
                </button>
            </div>
        </form>
    </div>
</body>
</html>
