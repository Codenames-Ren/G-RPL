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

<div id="detailModal" class="fixed inset-0 z-[80] hidden">
    <div class="absolute inset-0 bg-[#1A1A2E]/60" data-close-detail></div>
    <div class="relative max-w-6xl mx-auto my-6 bg-white rounded-xl shadow-2xl max-h-[calc(100vh-48px)] overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 flex items-start justify-between gap-4">
            <div>
                <h3 id="detailTitle" class="font-heading text-lg font-bold text-[#1A1A2E]">Detail Pengajuan</h3>
                <p id="detailSubtitle" class="text-xs text-[#5A6478] mt-1">Memuat detail application.</p>
            </div>
            <button type="button" data-close-detail class="w-9 h-9 rounded-lg border border-gray-200 text-[#5A6478] hover:bg-gray-50 font-bold">x</button>
        </div>
        <div id="detailBody" class="overflow-y-auto p-6 space-y-6">
            <p class="text-sm text-[#5A6478]">Memuat detail...</p>
        </div>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const table = document.getElementById('applicationsTable');
    const statusFilter = document.getElementById('statusFilter');
    const searchInput = document.getElementById('searchInput');
    const detailModal = document.getElementById('detailModal');
    const detailTitle = document.getElementById('detailTitle');
    const detailSubtitle = document.getElementById('detailSubtitle');
    const detailBody = document.getElementById('detailBody');
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
                    <div class="inline-flex items-center justify-center gap-2">
                        <button type="button" data-open-detail="${esc(app.id)}" class="px-3 py-1.5 border border-[#1565C0]/25 text-[#1565C0] text-[10px] font-bold rounded-lg hover:bg-[#E3F0FF] transition-colors">Detail</button>
                        ${app.status === 'submitted'
                            ? `<a href="{{ route('manager.assignment') }}" class="px-3 py-1.5 bg-[#1565C0] text-white text-[10px] font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Assign</a>`
                            : ''}
                        ${app.status === 'submitted' ? `<button type="button" data-reject-application="${esc(app.id)}" class="px-3 py-1.5 bg-red-50 text-red-700 border border-red-100 text-[10px] font-bold rounded-lg hover:bg-red-100 transition-colors">Reject</button>` : ''}
                    </div>
                </td>
            </tr>
        `).join('');
    }

    const renderDocuments = (documents) => {
        if (!documents?.length) return '<p class="text-xs text-[#5A6478]">Belum ada dokumen.</p>';
        return documents.map((doc) => `
            <a href="/storage/${esc(doc.file_path)}?v=${esc(doc.updated_at || Date.now())}" target="_blank" class="flex items-center justify-between gap-4 border border-gray-100 rounded-lg p-3 hover:border-[#1565C0]/40">
                <div>
                    <p class="text-xs font-bold text-[#1A1A2E]">${esc(doc.document_type || doc.type)}</p>
                    <p class="text-[10px] text-[#5A6478] mt-0.5">${esc(doc.file_name || doc.file_path)}</p>
                </div>
                <span class="text-[10px] font-bold text-[#1565C0]">Buka</span>
            </a>
        `).join('');
    };

    const renderExperiences = (experiences) => {
        if (!experiences?.length) return '<p class="text-xs text-[#5A6478]">Belum ada learning experience.</p>';
        return experiences.map((item, index) => `
            <div class="border border-gray-100 rounded-lg p-4">
                <p class="text-sm font-bold text-[#1A1A2E]">${index + 1}. ${esc(item.title || item.judul || item.nama_pengalaman)}</p>
                <p class="text-xs text-[#5A6478] mt-1 leading-relaxed">${esc(item.description || item.deskripsi || item.reflection || item.pengalaman)}</p>
            </div>
        `).join('');
    };

    const renderAssignments = (assignments) => {
        if (!assignments?.length) return '<p class="text-xs text-[#5A6478]">Belum ada assignment asesor.</p>';
        return assignments.map((assignment) => `
            <div class="border border-gray-100 rounded-lg p-3">
                <p class="text-xs font-bold text-[#1A1A2E]">${esc(assignment.asesor?.nama)}</p>
                <p class="text-[10px] text-[#5A6478] mt-1">Manager: ${esc(assignment.manager?.nama)} | ${esc(assignment.assigned_at)}</p>
            </div>
        `).join('');
    };

    const renderAssessmentDetails = (assessment) => {
        const rows = assessment?.assessment_details || assessment?.assessmentDetails || [];
        if (!assessment) return '<p class="text-xs text-[#5A6478]">Belum ada hasil assessment dari asesor.</p>';
        if (!rows.length) return '<p class="text-xs text-[#5A6478]">Assessment tidak memiliki detail konversi SKS. Kemungkinan status rejected.</p>';
        return rows.map((item, index) => `
            <div class="border border-[#1565C0]/15 rounded-lg p-4">
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-3">
                    <div>
                        <p class="text-[11px] font-bold text-[#1565C0] uppercase tracking-wider">Konversi ${index + 1}</p>
                        <p class="text-sm font-bold text-[#1A1A2E] mt-1">${esc(item.course?.kode_mk)} - ${esc(item.course?.nama_matkul)}</p>
                    </div>
                    <div class="flex gap-2">
                        <span class="px-2 py-1 rounded bg-blue-50 text-[#1565C0] text-[10px] font-bold">${esc(item.sks_diakui)} SKS</span>
                        <span class="px-2 py-1 rounded bg-green-50 text-green-700 text-[10px] font-bold">Nilai ${esc(item.nilai_konversi)}</span>
                    </div>
                </div>
            </div>
        `).join('');
    };

    async function openDetail(id) {
        detailModal.classList.remove('hidden');
        detailBody.innerHTML = '<p class="text-sm text-[#5A6478]">Memuat detail pengajuan...</p>';
        try {
            const { data: app } = await axios.get(`/api/manager/applications/${id}`);
            const experiences = app.learning_experiences || app.learningExperiences || [];
            const assessment = app.assessments?.[0] || null;

            detailTitle.textContent = app.applicant?.nama || 'Detail Pengajuan';
            detailSubtitle.textContent = `${app.prodi?.nama_prodi || '-'} | APP-${String(app.id).slice(0, 8).toUpperCase()} | ${app.status}`;
            detailBody.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                        <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Dokumen Applicant</h4>
                        <div class="space-y-3">${renderDocuments(app.documents || [])}</div>
                    </section>
                    <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                        <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Learning Experiences</h4>
                        <div class="space-y-3">${renderExperiences(experiences)}</div>
                    </section>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <section class="bg-white border border-[#1565C0]/15 rounded-xl p-5">
                        <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Assignment Asesor</h4>
                        <div class="space-y-3">${renderAssignments(app.assignments || [])}</div>
                    </section>
                    <section class="lg:col-span-2 border border-[#1565C0]/15 rounded-xl p-5">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4">
                            <div>
                                <h4 class="text-sm font-bold text-[#1A1A2E]">Hasil Assessment Asesor</h4>
                                <p class="text-xs text-[#5A6478] mt-1">${esc(assessment?.notes || app.rejection_note || 'Belum ada catatan assessment.')}</p>
                            </div>
                            <span class="px-3 py-1.5 rounded text-xs font-bold uppercase ${statusClass(app.status)}">${esc(app.status)}</span>
                        </div>
                        <div class="space-y-3">${renderAssessmentDetails(assessment)}</div>
                    </section>
                </div>
            `;
        } catch (error) {
            detailBody.innerHTML = `<p class="text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat detail pengajuan.')}</p>`;
        }
    }

    async function rejectApplication(id) {
        const note = window.prompt('Masukkan alasan reject untuk applicant:');
        if (!note) return;

        try {
            await axios.patch(`/api/manager/applications/${id}/reject`, { rejection_note: note });
            await loadApplications();
        } catch (error) {
            window.alert(error.response?.data?.message || 'Gagal reject application.');
        }
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
    table.addEventListener('click', (event) => {
        const button = event.target.closest('[data-reject-application]');
        if (button) rejectApplication(button.dataset.rejectApplication);
        const detailButton = event.target.closest('[data-open-detail]');
        if (detailButton) openDetail(detailButton.dataset.openDetail);
    });
    document.addEventListener('click', (event) => {
        if (event.target.closest('[data-close-detail]')) detailModal.classList.add('hidden');
    });
    loadApplications();
});
</script>

@endsection
