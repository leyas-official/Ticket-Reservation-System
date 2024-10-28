@props(['active' => false])

<a class="{{ $active ? 'text-white bg-blue-900' : 'text-gray-200 hover:bg-blue-800 hover:text-blue-100' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
