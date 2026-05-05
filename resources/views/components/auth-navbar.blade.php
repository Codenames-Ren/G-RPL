{{-- resources/views/components/auth-navbar.blade.php --}}
{{-- Usage: <x-auth-navbar right-text="..." right-link="..." right-label="..." /> --}}

<nav class="bg-white border-b border-[#1565C0]/10 px-7 h-14 flex items-center justify-between">
    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL" class="h-8 w-auto">
        <span class="font-heading font-bold text-[#1565C0] text-base leading-none">Sistem RPL</span>
    </a>

    @if(isset($rightSlot))
        <div class="text-sm text-[#5A6478]">{{ $rightSlot }}</div>
    @endif
</nav>