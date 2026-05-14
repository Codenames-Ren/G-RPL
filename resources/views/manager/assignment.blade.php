{{-- resources/views/manager/assignment.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Assign Asesor ke Pengajuan')
@section('manager_content')

@if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-bold text-green-700">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm font-bold text-red-700">
        {{ $errors->first() }}
    </div>
@endif

<div class="mb-6">
    <div class="flex items-center gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
        <svg class="w-5 h-5 text-[#F9A825] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <p class="text-xs text-[#5A6478]"><strong class="text-[#1A1A2E]">{{ $applications->count() }} pengajuan</strong> menunggu untuk ditugaskan ke asesor. Pilih application, pilih asesor yang sesuai prodi, lalu buat assignment.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Menunggu Asesor</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Alur manager: pilih application submitted, pilih asesor, lalu status menjadi assigned</p>
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
                    @forelse($applications as $application)
                        @php
                            $applicantName = $application->applicant?->nama ?? '-';
                            $prodiName = $application->prodi?->nama_prodi ?? '-';
                            $jenisRpl = $application->jenis_RPL ?? $application->jenis_rpl ?? '-';
                            $modalPayload = [
                                'id' => $application->id,
                                'name' => $applicantName,
                                'prodi' => $prodiName,
                                'asesors' => $asesors
                                    ->filter(fn ($asesor) => $asesor->prodis->contains('id', $application->prodi_id))
                                    ->values()
                                    ->map(fn ($asesor) => [
                                        'id' => $asesor->id,
                                        'nama' => $asesor->nama,
                                        'bidang' => $asesor->bidang_keahlian,
                                        'queue' => $asesor->assignments_count,
                                    ]),
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">{{ $applicantName }}</td>
                            <td class="px-6 py-4 text-xs text-[#5A6478]">{{ $prodiName }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $jenisRpl === 'A' ? 'bg-blue-50 text-[#1565C0]' : 'bg-orange-50 text-[#E65100]' }}">Tipe {{ $jenisRpl }}</span>
                            </td>
                            <td class="px-6 py-4 text-xs text-[#5A6478]">{{ optional($application->updated_at)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <button
                                    class="px-4 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors"
                                    onclick='openAssignModal(@json($modalPayload))'
                                >
                                    Pilih Asesor
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Tidak ada pengajuan submitted yang menunggu asesor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Asesor Tersedia</h2>
        <p class="text-xs text-[#5A6478] mb-4">Asesor ditampilkan bersama prodi dan beban assignment aktif.</p>

        <div class="space-y-3">
            @forelse($asesors as $asesor)
                <div class="flex items-center gap-3 p-3 border border-gray-100 rounded-lg hover:border-[#1565C0]/30 transition-colors">
                    <div class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-sm flex-shrink-0">
                        {{ str($asesor->nama)->substr(0, 2)->upper() }}
                    </div>
                    <div class="flex-grow min-w-0">
                        <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $asesor->nama }}</p>
                        <p class="text-[10px] text-[#5A6478] truncate">{{ $asesor->prodis->pluck('nama_prodi')->join(', ') ?: $asesor->bidang_keahlian }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-[10px] text-[#5A6478]">Antrean: {{ $asesor->assignments_count }}</span>
                            <span class="w-1.5 h-1.5 rounded-full {{ $asesor->assignments_count > 2 ? 'bg-yellow-500' : 'bg-green-500' }}"></span>
                            <span class="text-[10px] font-bold {{ $asesor->assignments_count > 2 ? 'text-yellow-600' : 'text-green-600' }}">{{ $asesor->assignments_count > 2 ? 'Padat' : 'Tersedia' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-[#5A6478]">Belum ada data asesor.</p>
            @endforelse
        </div>
    </div>
</div>

<div id="assignModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50" style="display: none;">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-heading font-bold text-[#1A1A2E]">Assign Asesor</h3>
            <button onclick="closeAssignModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <p class="text-sm text-[#5A6478] mb-1">Applicant: <strong id="modalApplicantName" class="text-[#1A1A2E]">-</strong></p>
        <p class="text-xs text-[#5A6478] mb-4">Prodi: <strong id="modalProdiName" class="text-[#1A1A2E]">-</strong></p>

        <form id="assignForm" method="POST" action="">
            @csrf
            <select id="asesorSelect" name="asesor_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm mb-6 outline-none focus:border-[#1565C0]">
                <option value="">Pilih Asesor...</option>
            </select>
            <p id="emptyAsesorMessage" class="hidden text-xs text-red-600 font-bold mb-6">Tidak ada asesor yang sesuai dengan prodi application ini.</p>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeAssignModal()" class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-bold rounded-lg hover:bg-gray-50">Batal</button>
                <button id="submitAssignButton" type="submit" class="px-6 py-2 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Assign</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAssignModal(application) {
        const form = document.getElementById('assignForm');
        const select = document.getElementById('asesorSelect');
        const emptyMessage = document.getElementById('emptyAsesorMessage');
        const submitButton = document.getElementById('submitAssignButton');

        document.getElementById('modalApplicantName').textContent = application.name;
        document.getElementById('modalProdiName').textContent = application.prodi;
        form.action = `/manager/applications/${application.id}/assign`;
        select.innerHTML = '<option value="">Pilih Asesor...</option>';

        application.asesors.forEach((asesor) => {
            const option = document.createElement('option');
            option.value = asesor.id;
            option.textContent = `${asesor.nama} - ${asesor.bidang} (${asesor.queue} antrean)`;
            select.appendChild(option);
        });

        const hasAsesor = application.asesors.length > 0;
        emptyMessage.classList.toggle('hidden', hasAsesor);
        submitButton.disabled = !hasAsesor;
        submitButton.classList.toggle('opacity-50', !hasAsesor);
        document.getElementById('assignModal').style.display = 'flex';
    }

    function closeAssignModal() {
        document.getElementById('assignModal').style.display = 'none';
    }
</script>

@endsection
