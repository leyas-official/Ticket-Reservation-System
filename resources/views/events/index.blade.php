<x-layout>
    <x-slot:head>
        <!-- Search Navigation Bar -->
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Event Ticketing</h1>
            <div class="flex flex-row items-center gap-4">
                <form action="{{ route('events') }}" class="flex items-center  justify-center w-full max-w-lg " method="GET">
                    @csrf
                    <input
                    type="text"
                    placeholder="Search Events..."
                    name="search"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button
                        type="submit"
                        class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition duration-200 ml-2"
                    >
                       <span class="ml-2"> Search </span>
                    </button>
                </form>
            </div>
            <a
            href="{{ route('events') }}"
            class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition duration-200 ml-2 "
            >
            <span class="ml-2">All Events </span>

            </a>
        </div>
    </x-slot:head>
    <div class="relative overflow-x-auto  sm:rounded-lg p-6">
        @if(session('success'))
            <div id="success-message" class="relative mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                <button onclick="document.getElementById('success-message').style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900 focus:outline-none text-lg">
                    &times;
                </button>
                {{ session('success') }}
            </div>
        @endif


        @if(count($events) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Box -->
            @foreach ($events as $event)

            <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg group">
                <h1 class="text-2xl font-bold text-black group-hover:text-blue-900"> {{ $event['name'] }}</h1>

                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Location :  {{ $event['location']['name'] }}
                </p>

                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Date :  {{ $event->date }}
                </p>

                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Time :  {{ $event->time }}
                </p>

                <p class="text-gray-500 mt-2 flex items-center truncate">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Description : <span class="truncate max-w-xs">{{ $event->description }}</span>
                </p>

                <p class="text-gray-700 mt-2 font-semibold flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Price : {{ $event->price }}
                </p>

                <a href="{{ route('book', $event->id) }}" class="mt-6 inline-block text-center text-white bg-blue-800 hover:bg-blue-900 font-medium py-2 rounded-lg transition-colors duration-200">Book Now</a>
            </div>

            @endforeach


        </div>
        @else
        <div class="max-w-lg mx-auto p-6 mt-6 bg-red-50 border border-red-300 text-red-800 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold">Oops! No Events Found</h2>
            <p class="mt-2 text-sm">It seems there are currently no events available. We’re working hard to bring you new events soon!</p>
            <p class="mt-2 text-sm">You can also try searching for different events:</p>
            <p class="mt-2 font-medium text-blue-600">{{ old('search') }}</p>
            <div class="mt-4">
                <a href="{{ route('events') }}" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition duration-200">
                    View All Events
                </a>
            </div>
        </div>

        @endif

    </div>
</x-layout>
