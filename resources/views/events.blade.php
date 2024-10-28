<x-layout>
    <x-slot:head>
        <!-- Search Navigation Bar -->
        <div class="w-full bg-white shadow-md rounded-lg p-4 mb-6 mx-4 flex items-center justify-between">
            <h1 class="text-xl font-bold text-blue-900">Event Ticketing</h1>
            <form action="#" class="flex items-center w-full max-w-lg">
                <input
                    type="text"
                    placeholder="Search events..."
                    class="w-full px-4 py-2 border border-r-0 border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <select
                    class="px-4 py-2 border  border-gray-300  rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500 "
                >
                    <option value="1">Location</option>
                    <option value="2">New York</option>
                    <option value="3">Los Angeles</option>
                    <option value="4">Chicago</option>
                </select>
                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ml-2"
                >
                    Search
                </button>
            </form>
        </div>
    </x-slot:head>
    <div class="relative overflow-x-auto  sm:rounded-lg p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Event Box -->
            <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg">
                <h1 class="text-2xl font-bold text-blue-900">Event Name</h1>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Location
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Date
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Time
                </p>
                <p class="text-gray-700 mt-2 font-semibold flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Price
                </p>
                <a href="#" class="mt-6 inline-block text-center text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 rounded-lg transition-colors duration-300">Book Now</a>
            </div>

            <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg">
                <h1 class="text-2xl font-bold text-blue-900">Event Name</h1>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Location
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Date
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Time
                </p>
                <p class="text-gray-700 mt-2 font-semibold flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Price
                </p>
                <a href="#" class="mt-6 inline-block text-center text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 rounded-lg transition-colors duration-300">Book Now</a>
            </div>

            <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg">
                <h1 class="text-2xl font-bold text-blue-900">Event Name</h1>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Location
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Date
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Time
                </p>
                <p class="text-gray-700 mt-2 font-semibold flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Price
                </p>
                <a href="#" class="mt-6 inline-block text-center text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 rounded-lg transition-colors duration-300">Book Now</a>
            </div>
            <div class="box flex flex-col bg-white shadow-md rounded-xl p-6 transition-shadow hover:shadow-lg">
                <h1 class="text-2xl font-bold text-blue-900">Event Name</h1>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Location
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Date
                </p>
                <p class="text-gray-500 mt-2 flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Time
                </p>
                <p class="text-gray-700 mt-2 font-semibold flex items-center">
                    <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="..."/></svg>
                    Price
                </p>
                <a href="#" class="mt-6 inline-block text-center text-white bg-blue-600 hover:bg-blue-700 font-medium py-2 rounded-lg transition-colors duration-300">Book Now</a>
            </div>
        </div>
    </div>
</x-layout>
