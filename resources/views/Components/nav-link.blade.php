@props(['active' => false])
<a class="{{ $active ? 'bg-gray-800 text-yellow-400' : 'text-gray-300 hover:bg-gray-700 hover:text-yellow-400' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
