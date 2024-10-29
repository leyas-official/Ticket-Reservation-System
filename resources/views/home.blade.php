<x-layout>
    <x-slot:head>
        <div class="flex flex-col md:flex-row bg-white shadow-lg justify-between items-center px-6 py-8 mt-6 border border-gray-200 rounded-lg max-w-4xl mx-auto transition duration-300 hover:bg-gray-100 cursor-pointer">
            <div class="content max-w-md">
                <h1 class="text-3xl font-bold text-blue-900">Tripoli Ticket System</h1>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Welcome to the Tripoli Ticket System! This platform is your gateway to discovering and booking tickets for events, attractions, and activities in the vibrant city of Tripoli. From Football matches, local festivals, cultural events and so on. our system helps you explore and reserve tickets with ease.
                </p>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Our features include real-time ticket availability, detailed event information, and a user-friendly booking interface to enhance your experience. Start by browsing upcoming events or securing a reservation to enjoy the best events that Tripoli has to offer.
                </p>
            </div>
            <img src="{{ asset('images/ticket.jfif') }}" alt="Ticket System Logo" class="w-32 md:w-40 lg:w-48 mt-4 md:mt-0 md:ml-8 rounded-lg">
        </div>
    </x-slot:head>
</x-layout>
