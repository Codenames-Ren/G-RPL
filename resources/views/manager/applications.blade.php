{{-- resources/views/manager/applications.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Kelola Pengajuan RPL')
@section('manager_content')

<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Kelola Pengajuan</h2>
        <p class="text-sm text-[#5A6478] mt-1">Review seluruh application yang masuk dari endpoint manager.</p>
    </div>
    <a href="{{ route('manager.assignment') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Assign Asesor</a>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Pengajuan</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Data dimuat dari endpoint <code>/api/manager/applications</code>.</p>
        </div>
        <div class="flex gap-2 flex-wrap">
            <select id="statusFilter" class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0]">
                <option value="all">Semua Status</option>
                <option value="submitted">Submitted</option>
                <option value="assigned">Assigned</option>
                <option value="assessed">Assessed</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
            <input id="searchInput" type="text" placeholder="Cari nama..." class="text-xs border border-gray-300 rounded-lg px-3 py-2 outline-none focus:border-[#1565C0] w-40">
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Applicant</th>
                    <th class="px-6 py-4">Prodi Tujuan</th>
                    <th class="px-6 py-4">Tipe RPL</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Asesor</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="applicationsTable" class="divide-y divide-gray-50">
                <tr><td colspan="7" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const table = document.getElementById('applicationsTable');
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    let applications = [];

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const statusClass = (status) => ({
        submitted: 'bg-blue-50 text-blue-700',
        assigned: 'bg-purple-50 text-purple-700',
        assessed: 'bg-yellow-50 text-yellow-700',
        approved: 'bg-green-50 text-green-700',
        rejected: 'bg-red-50 text-red-700',
    }[status] || 'bg-gray-50 text-gray-700');

    function render() {
        const status = statusFilter.value;
        const q = searchInput.value.toLowerCase();
        const rows = applications.filter((app) => {
            const name = app.applicant?.nama || '';
            return (status === 'all' || app.status === status) && (!q || name.toLowerCase().includes(q));
        });

        if (!rows.length) {
            table.innerHTML = '<tr><td colspan="7" class="px-6 py-10 text-center text-sm text-[#5A6478]">Tidak ada pengajuan.</td></tr>';
            return;
        }

        table.innerHTML = rows.map((app) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4"><span class="text-[10px] font-mono text-[#5A6478] bg-gray-50 px-2 py-1 rounded">APP-${esc(app.id).slice(0, 8).toUpperCase()}</span></td>
                <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-[#1565C0]">Tipe ${esc(app.jenis_RPL || app.jenis_rpl)}</span></td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded text-[10px] font-bold ${statusClass(app.status)}">${esc(app.status)}</span></td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.latest_assignment?.asesor?.nama)}</td>
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('manager.assignment') }}" class="px-3 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">${app.status === 'submitted' ? 'Assign' : 'Detail'}</a>
                </td>
            </tr>
        `).join('');
    }

    async function loadApplications() {
        try {
            const { data } = await axios.get('/api/manager/applications');
            applications = data;
            render();
        } catch (error) {
            table.innerHTML = `<tr><td colspan="7" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat endpoint manager.')}</td></tr>`;
        }
    }

    statusFilter.addEventListener('change', render);
    searchInput.addEventListener('input', render);
    loadApplications();
});
</script>

@endsection
