@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#1565C0] focus:ring-[#1565C0] rounded-md shadow-sm']) }}>
