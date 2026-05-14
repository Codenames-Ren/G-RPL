{{-- resources/views/manager/asesors.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Data Asesor')
@section('manager_content')

<div class="flex justify-between items-center mb-6 gap-4">
    <p class="text-xs text-[#5A6478]">Data asesor diambil dari backend dan dipakai saat manager membuat assignment.</p>
    <a href="{{ route('manager.assignment') }}" class="px-4 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">
        Assign Asesor
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($asesors as $asesor)
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg flex-shrink-0">
                    {{ str($asesor->nama)->substr(0, 2)->upper() }}
                </div>
                <div class="min-w-0">
                    <h3 class="font-heading font-bold text-[#1A1A2E] truncate">{{ $asesor->nama }}</h3>
                    <p class="text-xs text-[#5A6478]">{{ $asesor->prodis->pluck('nama_prodi')->join(', ') ?: $asesor->bidang_keahlian }}</p>
                </div>
            </div>

            <div class="space-y-2 mb-4 text-xs text-[#5A6478]">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ $asesor->user?->email ?? '-' }}
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M8 7h8"></path></svg>
                    NIDN: {{ $asesor->nidn }}
                </div>
            </div>

            <div class="flex items-center gap-4 mb-4">
                <div>
                    <p class="text-[10px] text-[#5A6478]">Antrean</p>
                    <p class="text-lg font-bold {{ $asesor->assignments_count > 2 ? 'text-[#D32F2F]' : 'text-[#1565C0]' }}">{{ $asesor->assignments_count }}</p>
                </div>
                <div>
                    <p class="text-[10px] text-[#5A6478]">Selesai</p>
                    <p class="text-lg font-bold text-green-600">{{ $asesor->completed_assignments_count }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <p class="text-xs text-[#5A6478]">{{ $asesor->bidang_keahlian }}</p>
            </div>
        </div>
    @empty
        <div class="md:col-span-2 lg:col-span-3 bg-white border border-[#1565C0]/15 rounded-xl p-10 text-center text-sm text-[#5A6478]">
            Belum ada data asesor.
        </div>
    @endforelse
</div>

@endsection
