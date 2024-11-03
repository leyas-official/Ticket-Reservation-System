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
{{--            <a--}}
{{--            href="{{ route('events') }}"--}}
{{--            class="bg-blue-800 text-white px-4 py-2 rounded-md hover:bg-blue-900 transition duration-200 ml-2 "--}}
{{--            >--}}
{{--            <span class="ml-2">All Events </span>--}}

{{--            </a>--}}
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
                <div class="flex flex-col gap-6">  <!-- Changed to flex flex-col -->
                    @foreach ($events as $event)
                        <div class="box bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg group w-full">  <!-- Added w-full -->
                            <h1 class="text-2xl font-bold text-black group-hover:text-blue-900">{{ $event['name'] }}</h1>

                            <p class="text-gray-500 mt-2 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.902C12.95 21.367 12.282 21.367 11.818 20.902L8 18l-3.818 2.902C3.717 21.367 3.049 21.367 2.586 20.902L2 20c-1.103 0-2-.897-2-2v-1h2v-1a2 2 0 012-2h-2v-1h2a2 2 0 002-2h-2v-1h2v-1a2 2 0 012-2h-2V6a2 2 0 012-2h2v1H9V3h8v1H9v2h8v1h-2v2h2v1h-2z"></path></svg>
                                Location : {{ $event['location']['name'] }}
                            </p>
                            <p class="text-gray-500 mt-2 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Date :  {{ $event->date }}
                            </p>
                            <p class="text-gray-500 mt-2 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Time :  {{ $event->time }}
                            </p>

                            <p class="text-gray-500 mt-2 flex items-center truncate">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Description : <span class="truncate max-w-xs">{{ $event->description }}</span>
                            </p>


                            <p class="text-gray-700 mt-2 font-semibold flex items-center">
                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>                    Price : {{ $event->price }}
                            </p>
                            <a href="{{ route('book', $event->id) }}" class="mt-6 inline-block text-center text-white bg-blue-800 hover:bg-blue-900 font-medium py-2 rounded-lg transition-colors duration-200">Book Now</a>
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
    </div>
</x-layout>
