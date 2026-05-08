{{-- resources/views/manager/assignment.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Assign Asesor ke Pengajuan')
@section('manager_content')

<div class="mb-6">
    <div class="flex items-center gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
        <svg class="w-5 h-5 text-[#F9A825] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <p class="text-xs text-[#5A6478]"><strong class="text-[#1A1A2E]">23 pengajuan</strong> menunggu untuk ditugaskan ke asesor. Segera lakukan assignment agar proses asesmen berjalan.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Daftar Pengajuan Belum Diassign --}}
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Menunggu Asesor</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Pilih pengajuan dan tentukan asesor yang sesuai bidangnya</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Applicant</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4">Tgl Submit</th>
                        <th class="px-6 py-4 text-center">Assign</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @php
                        $unassigned = [
                            ['Budi Santoso', 'S1 Teknik Informatika', 'Tipe A', '01 Mei 2026'],
                            ['Rina Wijaya', 'D3 Manajemen', 'Tipe A', '03 Mei 2026'],
                            ['Maya Sari', 'S1 Teknik Informatika', 'Tipe A', '05 Mei 2026'],
                            ['Ahmad Fauzi', 'S1 Sistem Informasi', 'Tipe B', '06 Mei 2026'],
                            ['Dewi Lestari', 'S1 Akuntansi', 'Tipe B', '07 Mei 2026'],
                        ];
                    @endphp
                    @foreach($unassigned as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $item[0] }}</td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $item[1] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $item[2] == 'Tipe A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">{{ $item[2] }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $item[3] }}</td>
                        <td class="px-6 py-4 text-center">
                            <button class="px-4 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors" onclick="openAssignModal('{{ $item[0] }}')">
                                Pilih Asesor
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Daftar Asesor Tersedia --}}
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Asesor Tersedia</h2>
        <p class="text-xs text-[#5A6478] mb-4">Asesor dengan beban kerja rendah diprioritaskan</p>
        
        <div class="space-y-3">
            @foreach([
                ['Dr. Darmawan', 'S1 Teknik Informatika', 2, 'Tersedia'],
                ['Prof. Linda', 'S1 Sistem Informasi', 1, 'Tersedia'],
                ['Dr. Rahman', 'S1 Akuntansi', 0, 'Siap'],
                ['Dr. Susanto', 'S1 Teknik Elektro', 3, 'Tersedia'],
                ['Dr. Kartika', 'D3 Manajemen', 1, 'Tersedia'],
            ] as $asesor)
            <div class="flex items-center gap-3 p-3 border border-gray-100 rounded-lg hover:border-[#1565C0]/30 transition-colors">
                <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-sm flex-shrink-0">
                    {{ substr($asesor[0], 0, 2) }}
                </div>
                <div class="flex-grow min-w-0">
                    <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $asesor[0] }}</p>
                    <p class="text-[10px] text-[#5A6478] truncate">{{ $asesor[1] }}</p>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[10px] text-[#5A6478]">Antrean: {{ $asesor[2] }}</span>
                        <span class="w-1.5 h-1.5 rounded-full {{ $asesor[3] == 'Siap' ? 'bg-green-500' : 'bg-blue-500' }}"></span>
                        <span class="text-[10px] font-bold {{ $asesor[3] == 'Siap' ? 'text-green-600' : 'text-blue-600' }}">{{ $asesor[3] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Modal Assign Asesor (Dummy) --}}
<div id="assignModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50" style="display: none;">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-heading font-bold text-[#1A1A2E]">Assign Asesor</h3>
            <button onclick="closeAssignModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <p class="text-sm text-[#5A6478] mb-4">Pilih asesor untuk <strong id="modalApplicantName" class="text-[#1A1A2E]">-</strong></p>
        <select class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm mb-6 outline-none focus:border-[#1565C0]">
            <option>Pilih Asesor...</option>
            <option>Dr. Darmawan - S1 Teknik Informatika</option>
            <option>Prof. Linda - S1 Sistem Informasi</option>
            <option>Dr. Rahman - S1 Akuntansi</option>
            <option>Dr. Susanto - S1 Teknik Elektro</option>
        </select>
        <div class="flex gap-3 justify-end">
            <button onclick="closeAssignModal()" class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-bold rounded-lg hover:bg-gray-50">Batal</button>
            <button class="px-6 py-2 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Assign</button>
        </div>
    </div>
</div>

<script>
    function openAssignModal(name) {
        document.getElementById('modalApplicantName').textContent = name;
        document.getElementById('assignModal').style.display = 'flex';
    }
    function closeAssignModal() {
        document.getElementById('assignModal').style.display = 'none';
    }
</script>

@endsection