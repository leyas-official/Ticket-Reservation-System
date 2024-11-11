@props(['active' => false])

<a  class="flex items-center p-4 {{ $active ? 'text-white bg-gray-700' : 'text-gray-300' }} hover:bg-gray-700 hover:text-white" {{ $attributes }}>
   {{ $slot }}
</a>
