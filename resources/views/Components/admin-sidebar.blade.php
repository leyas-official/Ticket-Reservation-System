
<div class="flex">
    <!-- Sidebar -->
    <div class="bg-gray-800 text-white w-64 h-screen">
        <div class="flex items-center justify-center h-16 border-b border-gray-700">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
        </div>
        <nav class="mt-10">
            <a href="{{ route('dashboard')}}" class="flex items-center p-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span class="ml-4">Dashboard</span>
            </a>
            <a href="{{ route('admin.events')}}" class="flex items-center p-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span class="ml-4">Events</span>
            </a>
            <a href="#" class="flex items-center p-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span class="ml-4">Tickets</span>
            </a>
            <a href="#" class="flex items-center p-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span class="ml-4">Customers</span>
            </a>
            <a href="{{ route('signOut') }}" class="flex items-center p-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                <span class="ml-4">Logout</span>
            </a>
        </nav>
    </div>
