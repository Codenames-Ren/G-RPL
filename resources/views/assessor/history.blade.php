@extends('assessor.layout')
@section('page_title', 'Riwayat Asesmen')
@section('assessor_content')

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm">
    <div class="p-6 border-b border-gray-100">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Asesmen Selesai</h2>
        <p class="text-xs text-[#5A6478]">Daftar mahasiswa yang telah Anda berikan keputusan konversi SKS.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">SKS Diakui</th>
                    <th class="px-6 py-4">Nilai Konversi</th>
                    <th class="px-6 py-4">Keputusan</th>
                    <th class="px-6 py-4">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach([
                    ['Budi Santoso', '24 SKS', '3.75', 'Approved', 'text-green-600 bg-green-50'],
                    ['Ani Maryani', '18 SKS', '3.50', 'Approved', 'text-green-600 bg-green-50'],
                    ['Joko Susilo', '0 SKS', '0.00', 'Rejected', 'text-red-600 bg-red-50'],
                ] as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $item[0] }}</td>
                    <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">{{ $item[1] }}</td>
                    <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">{{ $item[2] }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $item[4] }}">{{ $item[3] }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <button class="text-[#1565C0] hover:underline text-xs font-bold">Lihat Laporan</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection