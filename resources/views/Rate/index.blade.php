<x-layout>
    <x-slot:head>

    </x-slot:head>

    <ul role="list" class="divide-y divide-gray-100">
        @foreach($events as $event)
            <li class="flex justify-between gap-x-6 py-5 bg-white px-10">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm/6 font-semibold text-gray-900">{{$event->name}}</p>
                        <p class="mt-1 truncate text-xs/5 text-gray-500">{{$event->location->name}}</p>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="mt-1 text-xs/5 text-gray-500">Event ended at :  <p class="text-sm/6 text-gray-900">{{$event->endDate}}</p>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="mt-1 text-xs/5 text-gray-500">Event type :  <p class="text-sm/6 text-gray-900">{{ucfirst($event->type)}}</p>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                    </svg>
                    <p class="ms-2 text-sm font-bold text-gray-900 dark:text-black">
                        @php
                        $sum = 0;
                        foreach($event->rate as $rate){
                            $sum += $rate->numberOfStars;
                        }
                        $avg = $sum / count($event->rate);
                        echo $avg;
                        @endphp
                    </p>
                    <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                    <a href="{{ route('Rate.eventRates', ['eventId' => $eventId])}}" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-black">{{count($event->rate)}} reviews</a>
                </div>
            </li>
        @endforeach
    </ul>


</x-layout>
