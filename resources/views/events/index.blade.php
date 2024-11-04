<x-layout>
    <x-slot:head>
        <!-- Search Navigation Bar -->
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-center">
            <div class="flex flex-row items-center gap-4">
                <form action="{{ route('events') }}" class="flex items-center  justify-center w-full max-w-lg " method="GET">
                    @csrf
                    <div class="relative w-[100rem]">
                        <input
                            type="text"
                            placeholder="Search Events..."
                            name="search"
                            class="w-full px-4 py-2 pl-10 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">  <!-- Search Icon Container -->
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <button type="submit" class="absolute inset-y-0 right-0 px-4 py-2 rounded-r-lg bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-950 text-white font-medium transition duration-200">
                            Search
                        </button>
                    </div>
                </form>
            </div>
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
        @elseif(session('error'))
            <div id="error-message" class="relative mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded-lg">
                <button onclick="document.getElementById('error-message').style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900 focus:outline-none text-lg">
                    &times;
                </button>
                {{ session('error') }}
            </div>
        @endif
        @if(count($events) > 0)
            <div class="flex flex-col gap-4 ">  <!-- Changed to flex flex-col -->
                @foreach ($events as $event)
                    <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-all duration-300 hover:shadow-lg group hover:-translate-y-1 cursor-pointer">
                        <!-- Event Name -->
                        <h1 class="text-2xl font-bold text-black group-hover:text-blue-900">{{ $event['name'] }}</h1>

                        <!-- Event Location -->
                        <p class="text-gray-500 mt-4 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Location: {{ $event['location']['name'] }}</span>
                        </p>

                        <!-- Event Date -->
                        <p class="text-gray-500 mt-2 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                              </svg>
                            <span>Date: {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</span>
                        </p>

                        <!-- Event Time -->
                        <p class="text-gray-500 mt-2 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                            <span>Time: {{  \Carbon\Carbon::parse($event->time)->format('h:i A') }}</span>
                        </p>

                        <!-- Event Description -->
                        <p class="text-gray-500 mt-2 flex items-center space-x-2 truncate">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                              </svg>
                            <span class="truncate max-w-xs hover:max-w-full transition-all duration-200">Description: {{ $event->description }}</span>
                        </p>

                        <!-- Event Price -->
                        <p class="text-gray-700 mt-2 font-semibold flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 text-yellow-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                        <span>Price: {{ $event->price }}</span>
                        </p>

                        <!-- Book Now Button -->
                        <a href="{{ route('book', $event->id) }}" class="mt-6 inline-block text-center text-white bg-blue-800 hover:bg-blue-900 font-medium py-2 px-6 rounded-lg transition-colors duration-200 ">
                            Book Now
                        </a>
                    </div>
                    @endforeach
            </div>
        </div>
        @else
        <div class="max-w-lg mx-auto p-6 mt-6 bg-red-50 border border-red-300 text-red-800 rounded-lg shadow-md text-center">
            <h2 class="text-lg font-semibold">Oops! No Events Found</h2>
            <p class="mt-2 text-sm">It seems there are currently no events available. We’re working hard to bring you new events soon!</p>
            <p class="mt-2 text-sm">You can also try searching for different events:</p>
            <p class="mt-2 font-medium text-blue-600">{{ old('search') }}</p>
            <div class="mt-8">
                <a href="{{ route('events') }}" class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition duration-200">
                    Back
                </a>
            </div>
        </div>
        @endif
</x-layout>
