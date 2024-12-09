<x-layout>
    <x-slot:head>

    </x-slot:head>
    <ul role="list" class="divide-y divide-gray-100">
        <li class="flex justify-between gap-x-6 py-5 bg-white px-10">
            <div class="flex min-w-0 gap-x-4">
{{--                <img class="size-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">--}}
                <div class="min-w-0 flex-auto">
                    <p class="text-sm/6 font-semibold text-gray-900">Lars Alexandersson</p>
                    <p class="mt-1 truncate text-xs/5 text-gray-500">leslie.alexander@example.com</p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p>
                <p class="mt-1 text-xs/5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
            </div>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                </svg>
                <p class="ms-2 text-sm font-bold text-gray-900 dark:text-black">4.95</p>
                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-black">73 reviews</a>
            </div>
        </li>
    </ul>
</x-layout>
