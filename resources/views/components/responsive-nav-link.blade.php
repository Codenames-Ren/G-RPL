@props(['active' => false])

@php
$classes = $active
    ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#1565C0] text-start text-base font-medium text-[#1565C0] bg-blue-50 focus:outline-none transition'
    : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
