<x-layout>
    <x-slot:head>
        <h1 class="text-3xl font-bold text-blue-900 text-center">Reserved Tickets</h1>
    </x-slot:head>
    <div class="relative overflow-x-auto shadow-lg sm:rounded-lg mt-4">
        @guest
            Nahhh u sholud be sign in
        @endguest
        @auth
            nah i would win
        @endauth
    </div>
</x-layout>
