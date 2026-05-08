@extends('assessor.layout')
@section('page_title', 'Antrean Penugasan')
@section('assessor_content')

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Tunggu Asesmen</h2>
            <p class="text-xs text-[#5A6478]">Segera lakukan penilaian pada aplikasi yang memiliki urgensi tinggi.</p>
        </div>
        <input type="text" placeholder="Cari Mahasiswa..." class="text-xs border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-64 outline-none focus:border-[#1565C0]">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">Prodi Tujuan</th>
                    <th class="px-6 py-4">Tgl Masuk</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach([
                    ['Andi Pratama', 'S1 Teknik Informatika', '01 Mei 2026', 'Overdue', 'text-red-600 bg-red-50'],
                    ['Siti Aminah', 'S1 Sistem Informasi', '04 Mei 2026', 'New', 'text-blue-600 bg-blue-50'],
                    ['Riko Wijaya', 'S1 Teknik Elektro', '05 Mei 2026', 'New', 'text-blue-600 bg-blue-50'],
                ] as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-[#1A1A2E]">{{ $item[0] }}</p>
                        <p class="text-[10px] text-gray-400">ID: RPL-{{ rand(1000,9999) }}</p>
                    </td>
                    <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">{{ $item[1] }}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $item[2] }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $item[4] }}">{{ $item[3] }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <button class="px-4 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1]">Mulai Penilaian</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection