@props(['active' => false])

<a class="{{ $active ? 'bg-white text-gray-700 outline-none ring-1 ring-gray-700 ring-offset-1 ring-offset-gray-800' : 'hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800'}} relative rounded-full bg-gray-700 p-1 text-gray-400 cursor-pointer" aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
