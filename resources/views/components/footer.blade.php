<footer class="bg-[#1A1A2E] px-7 py-12">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
        <div>
            <div class="flex items-center gap-2 mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-7 w-auto opacity-90">
                {{-- Teks diubah menjadi G-RPL --}}
                <span class="font-heading font-bold text-white text-lg">G-RPL</span>
            </div>
            <p class="text-xs text-white/40 max-w-xs">Mewujudkan pengakuan akademik atas pengalaman nyata Anda melalui sistem digital terintegrasi.</p>
        </div>
        <div class="flex gap-10">
            <div class="flex flex-col gap-2">
                <span class="text-white font-bold text-sm mb-2">Tautan</span>
                <a href="{{ route('about') }}" class="text-xs text-white/50 hover:text-white transition-colors">Tentang RPL</a>
                <a href="{{ route('requirements') }}" class="text-xs text-white/50 hover:text-white transition-colors">Persyaratan</a>
            </div>
            <div class="flex flex-col gap-2">
                <span class="text-white font-bold text-sm mb-2">Bantuan</span>
                <a href="{{ route('faq') }}" class="text-xs text-white/50 hover:text-white transition-colors">FAQ</a>
                <a href="#" class="text-xs text-white/50 hover:text-white transition-colors">Kontak Kami</a>
            </div>
        </div>
    </div>
    <div class="max-w-6xl mx-auto border-t border-white/5 mt-12 pt-6 text-center">
        {{-- Copyright juga disesuaikan --}}
        <p class="text-[10px] text-white/30 uppercase tracking-widest">© {{ date('Y') }} G-RPL Global Institute. All rights reserved.</p>
    </div>
</footer>