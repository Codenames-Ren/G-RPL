{{-- resources/views/assessor/dashboard.blade.php --}}
@extends('assessor.layout')
@section('page_title', 'Panel Penilaian Asesor')
@section('assessor_content')

<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Dashboard Asesor</h2>
        <p class="text-sm text-[#5A6478] mt-1">Review assignment, dokumen, learning experiences, lalu simpan assessment.</p>
    </div>
    <a href="{{ route('assessor.queue') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Buka Antrean</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Total Penugasan</p>
        <h3 id="totalAssignments" class="font-heading text-3xl font-extrabold text-[#1A1A2E]">0</h3>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Belum Dinilai</p>
        <h3 id="pendingAssignments" class="font-heading text-3xl font-extrabold text-[#F9A825]">0</h3>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider mb-2">Selesai Dinilai</p>
        <h3 id="doneAssignments" class="font-heading text-3xl font-extrabold text-green-600">0</h3>
    </div>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Antrean Penilaian Mahasiswa</h2>
            <p class="text-xs text-[#5A6478] mt-1">Data dari <code>/api/asesor/applications</code>.</p>
        </div>
        <a href="{{ route('assessor.queue') }}" class="text-xs font-bold text-[#1565C0] hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">Tipe RPL</th>
                    <th class="px-6 py-4">Program Studi</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="dashboardAssignments" class="divide-y divide-gray-50">
                <tr><td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const statusBadge = (status) => ({
        assigned: 'bg-yellow-50 text-yellow-700',
        approved: 'bg-green-50 text-green-700',
        rejected: 'bg-red-50 text-red-700',
    }[status] || 'bg-gray-50 text-gray-700');
    const tbody = document.getElementById('dashboardAssignments');

    try {
        const { data } = await axios.get('/api/asesor/applications');
        const pending = data.filter((app) => app.status === 'assigned');
        const done = data.filter((app) => ['approved', 'rejected'].includes(app.status));

        document.getElementById('totalAssignments').textContent = data.length;
        document.getElementById('pendingAssignments').textContent = pending.length;
        document.getElementById('doneAssignments').textContent = done.length;

        const rows = data.slice(0, 5);
        tbody.innerHTML = rows.length ? rows.map((app) => `
            <tr class="hover:bg-blue-50/30 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</p>
                    <p class="text-[10px] text-gray-400 font-mono">APP-${esc(app.id).slice(0, 8).toUpperCase()}</p>
                </td>
                <td class="px-6 py-4"><span class="px-2 py-1 bg-blue-50 text-[#1565C0] text-[10px] font-bold rounded-full">Tipe ${esc(app.jenis_RPL || app.jenis_rpl)}</span></td>
                <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded text-[10px] font-bold ${statusBadge(app.status)}">${esc(app.status)}</span></td>
                <td class="px-6 py-4 text-center"><a href="${['approved', 'rejected'].includes(app.status) ? '{{ route('assessor.history') }}' : '{{ route('assessor.queue') }}'}" class="inline-block px-4 py-2 bg-[#1565C0] text-white text-[11px] font-bold rounded-lg hover:bg-[#0D47A1]">Buka</a></td>
            </tr>
        `).join('') : '<tr><td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada assignment.</td></tr>';
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat endpoint asesor.')}</td></tr>`;
    }
});
</script>

@endsection
