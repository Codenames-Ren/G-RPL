{{-- resources/views/manager/assignment.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Assign Asesor ke Pengajuan')
@section('manager_content')

<div id="alertBox" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Assignment Asesor</h2>
        <p class="text-sm text-[#5A6478] mt-1">Pilih application submitted dan assign asesor yang sesuai dengan prodi.</p>
    </div>
    <a href="{{ route('manager.applications') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-[#1565C0]/30 text-[#1565C0] text-sm font-bold rounded-lg hover:bg-[#E3F0FF]">Daftar Pengajuan</a>
</div>

<div class="mb-6">
    <div class="flex items-center gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
        <svg class="w-5 h-5 text-[#F9A825] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"></path></svg>
        <p class="text-xs text-[#5A6478]"><strong id="pendingCount" class="text-[#1A1A2E]">0 pengajuan</strong> menunggu assignment. Data dan aksi memakai endpoint AssignmentController.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Menunggu Asesor</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">GET /api/manager/applications, POST /api/manager/applications/{id}/assign.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Applicant</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">Tipe</th>
                        <th class="px-6 py-4 text-center">Assign</th>
                    </tr>
                </thead>
                <tbody id="assignmentTable" class="divide-y divide-gray-50">
                    <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Asesor Sesuai Application</h2>
        <p class="text-xs text-[#5A6478] mb-4">Pilih application untuk load asesor dari endpoint `/asesors`.</p>
        <div id="asesorList" class="space-y-3 text-sm text-[#5A6478]">Belum ada application dipilih.</div>
    </div>
</div>

<div id="assignModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50" style="display: none;">
    <div class="bg-white rounded-xl p-6 w-full max-w-md shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-heading font-bold text-[#1A1A2E]">Assign Asesor</h3>
            <button id="closeModalButton" class="w-8 h-8 rounded-full bg-gray-50 text-gray-400 hover:text-gray-600 hover:bg-gray-100">X</button>
        </div>
        <p class="text-sm text-[#5A6478] mb-1">Applicant: <strong id="modalApplicantName" class="text-[#1A1A2E]">-</strong></p>
        <p class="text-xs text-[#5A6478] mb-4">Prodi: <strong id="modalProdiName" class="text-[#1A1A2E]">-</strong></p>
        <form id="assignForm">
            <select id="asesorSelect" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm mb-6 outline-none focus:border-[#1565C0]">
                <option value="">Pilih Asesor...</option>
            </select>
            <div class="flex gap-3 justify-end">
                <button type="button" id="cancelModalButton" class="px-4 py-2 border border-gray-300 text-gray-600 text-sm font-bold rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Assign</button>
            </div>
        </form>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const table = document.getElementById('assignmentTable');
    const pendingCount = document.getElementById('pendingCount');
    const asesorList = document.getElementById('asesorList');
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');
    const select = document.getElementById('asesorSelect');
    const alertBox = document.getElementById('alertBox');
    let selectedApplication = null;

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };

    async function openAssign(app) {
        selectedApplication = app;
        document.getElementById('modalApplicantName').textContent = app.applicant?.nama || '-';
        document.getElementById('modalProdiName').textContent = app.prodi?.nama_prodi || '-';
        select.innerHTML = '<option value="">Memuat asesor...</option>';
        asesorList.textContent = 'Memuat asesor...';
        modal.style.display = 'flex';
        modal.classList.remove('hidden');

        try {
            const { data } = await axios.get(`/api/manager/applications/${app.id}/asesors`);
            select.innerHTML = '<option value="">Pilih Asesor...</option>' + data.map((asesor) => `<option value="${esc(asesor.id)}">${esc(asesor.nama)} - ${esc(asesor.bidang_keahlian)}</option>`).join('');
            asesorList.innerHTML = data.length ? data.map((asesor) => `<div class="p-3 border border-gray-100 rounded-lg"><p class="text-xs font-bold text-[#1A1A2E]">${esc(asesor.nama)}</p><p class="text-[10px]">${esc(asesor.bidang_keahlian)}</p></div>`).join('') : 'Tidak ada asesor yang cocok dengan prodi application ini.';
        } catch (error) {
            select.innerHTML = '<option value="">Gagal memuat asesor</option>';
            asesorList.textContent = error.response?.data?.message || 'Gagal memuat asesor.';
        }
    }

    function closeModal() {
        modal.style.display = 'none';
        modal.classList.add('hidden');
    }

    async function loadApplications() {
        try {
            const { data } = await axios.get('/api/manager/applications');
            const rows = data.filter((app) => app.status === 'submitted' && !app.latest_assignment);
            pendingCount.textContent = `${rows.length} pengajuan`;
            if (!rows.length) {
                table.innerHTML = '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Tidak ada pengajuan submitted.</td></tr>';
                return;
            }
            table.innerHTML = rows.map((app, index) => `
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                    <td class="px-6 py-4 text-xs text-[#5A6478]">Tipe ${esc(app.jenis_RPL || app.jenis_rpl)}</td>
                    <td class="px-6 py-4 text-center"><button type="button" data-index="${index}" class="assign-button px-4 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1]">Pilih Asesor</button></td>
                </tr>
            `).join('');
            table.querySelectorAll('.assign-button').forEach((button) => button.addEventListener('click', () => openAssign(rows[Number(button.dataset.index)])));
        } catch (error) {
            table.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat endpoint manager.')}</td></tr>`;
        }
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        if (!selectedApplication || !select.value) return;
        try {
            await axios.post(`/api/manager/applications/${selectedApplication.id}/assign`, { asesor_id: select.value });
            closeModal();
            showAlert('Asesor assigned successfully.');
            loadApplications();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Assign gagal.', false);
        }
    });

    document.getElementById('closeModalButton').addEventListener('click', closeModal);
    document.getElementById('cancelModalButton').addEventListener('click', closeModal);
    loadApplications();
});
</script>

@endsection
