<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1565C0] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0D47A1] focus:outline-none focus:ring-2 focus:ring-[#1565C0] focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
