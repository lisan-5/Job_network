@props(['active' => false])
<a class="{{ $active ? 'bg-indigo-600 text-white' : 'text-gray-700 hover:bg-indigo-50 hover:text-indigo-600' }} rounded-lg px-4 py-3 text-base font-semibold transition-colors duration-200"
       aria-current="{{ $active ? 'page' : 'false' }}"
       {{ $attributes }}>
        {{ $slot }}
</a>

