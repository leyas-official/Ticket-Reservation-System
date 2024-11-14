@props(['active' => false])

<a class="{{ $active ? 'text-white bg-blue-900 dark:bg-gray-800' : 'text-gray-200 hover:bg-gray-500 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}
</a>
