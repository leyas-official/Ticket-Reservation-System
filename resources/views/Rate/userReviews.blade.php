<x-layout>
    <x-slot:head>

    </x-slot:head>
    <div class="flex justify-center">
        <a href="{{ route('reviewSubmit', [$event->id , Auth::user()->id ]) }}" class="mb-6 inline-block text-center text-white bg-blue-800 hover:bg-blue-900 font-medium py-2 px-6 rounded-lg transition-colors duration-200">
            Submit your review
        </a>
    </div>
    <ul role="list" class="divide-y divide-gray-100 ">
        @foreach($event->rate as $rate)
            <li class="gap-x-6 py-5 bg-white px-10 mb-5 rounded-lg">
                <div class="flex flex-row min-w-0 gap-x-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/340px-Default_pfp.svg.png?20220226140232" alt="Default Profile Picture" class="rounded-full w-16 h-16">
                    <div class="flex flex-col justify-center">
                        <p class="flex items-center text-sm/6 font-semibold text-gray-900 ">{{$rate->user->name}}</p>
                        <p class="flex items-center text-sm/6 font-semibold text-gray-500 ">{{$rate->user->email}}</p>
                    </div>
                </div>
                <div class="my-5 flex flex-row">
                    @php
                    $count = 0;
                    @endphp
                    @for ($i = 0; $i < $rate->numberOfStars; $i++)
                        @php
                            $count += 1
                        @endphp
                        <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                    @endfor
                    @if($count < 5)
                        @for (; $count < 5; $count++)
                            <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        @endfor
                    @endif
                </div>
                <div class="text-justify">
                    <p>{{$rate->description}}</p>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>
