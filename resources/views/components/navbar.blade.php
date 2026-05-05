<nav class="bg-white border-b border-[#1565C0]/10 px-7 h-14 flex items-center justify-between sticky top-0 z-50">
    <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="Logo G-RPL" class="h-8 w-auto">
        {{-- Teks diubah menjadi G-RPL --}}
        <span class="font-heading font-bold text-[#1565C0] text-base">G-RPL</span>
    </a>

    <div class="hidden md:flex items-center gap-6">
        @php
            $navItems = [
                ['name' => 'Beranda', 'route' => 'welcome'],
                ['name' => 'Tentang RPL', 'route' => 'about'],
                ['name' => 'Persyaratan', 'route' => 'requirements'],
                ['name' => 'FAQ', 'route' => 'faq'],
                ['name' => 'Pengumuman', 'route' => 'announcements'],
            ];
        @endphp

        @foreach($navItems as $item)
            <a href="{{ route($item['route']) }}" 
               class="text-sm transition-colors {{ Route::is($item['route']) ? 'text-[#1565C0] font-semibold border-b-2 border-[#1565C0] pb-0.5' : 'text-[#5A6478] hover:text-[#1565C0]' }}">
                {{ $item['name'] }}
            </a>
        @endforeach
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('login') }}"
           class="px-4 py-1.5 text-sm font-semibold text-[#1565C0] border border-[#1565C0] rounded-lg hover:bg-[#E3F0FF] transition-colors">
            Masuk
        </a>
        <a href="{{ route('register') }}"
           class="px-4 py-1.5 text-sm font-semibold text-white bg-[#1565C0] rounded-lg hover:bg-[#1976D2] transition-colors">
            Daftar Sekarang
        </a>
    </div>
</nav>