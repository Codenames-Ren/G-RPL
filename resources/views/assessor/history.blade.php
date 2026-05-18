{{-- resources/views/assessor/history.blade.php --}}
@extends('assessor.layout')
@section('page_title', 'Riwayat Asesmen')
@section('assessor_content')

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Asesmen Selesai</h2>
            <p class="text-xs text-[#5A6478] mt-1">Data riwayat dimuat dari endpoint <code>/api/asesor/applications</code>.</p>
        </div>
        <input id="searchInput" type="text" placeholder="Cari mahasiswa..." class="text-xs border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-64 outline-none focus:border-[#1565C0]">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">Prodi</th>
                    <th class="px-6 py-4">SKS Diakui</th>
                    <th class="px-6 py-4">Rata-rata Nilai</th>
                    <th class="px-6 py-4">Keputusan</th>
                    <th class="px-6 py-4">Catatan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="historyTable" class="divide-y divide-gray-50">
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
                <h3 id="detailTitle" class="font-heading text-lg font-bold text-[#1A1A2E]">Detail Assessment</h3>
                <p id="detailSubtitle" class="text-xs text-[#5A6478] mt-1">Memuat data application.</p>
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
    const table = document.getElementById('historyTable');
    const searchInput = document.getElementById('searchInput');
    const detailModal = document.getElementById('detailModal');
    const detailTitle = document.getElementById('detailTitle');
    const detailSubtitle = document.getElementById('detailSubtitle');
    const detailBody = document.getElementById('detailBody');
    let applications = [];

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const badge = (status) => status === 'approved' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700';
    const details = (app) => app.assessments?.[0]?.assessment_details || app.assessments?.[0]?.assessmentDetails || [];
    const totalSks = (app) => details(app).reduce((sum, item) => sum + Number(item.sks_diakui || 0), 0);
    const averageScore = (app) => {
        const rows = details(app);
        if (!rows.length) return '-';
        const avg = rows.reduce((sum, item) => sum + Number(item.nilai_konversi || 0), 0) / rows.length;
        return avg.toFixed(1);
    };
    const note = (app) => app.assessments?.[0]?.notes || app.rejection_note || '-';

    function render() {
        const q = searchInput.value.toLowerCase();
        const rows = applications
            .filter((app) => ['approved', 'rejected'].includes(app.status))
            .filter((app) => !q || (app.applicant?.nama || '').toLowerCase().includes(q));

        if (!rows.length) {
            table.innerHTML = '<tr><td colspan="7" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada assessment selesai.</td></tr>';
            return;
        }

        table.innerHTML = rows.map((app) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</p>
                    <p class="text-[10px] text-gray-400 font-mono">APP-${esc(app.id).slice(0, 8).toUpperCase()}</p>
                </td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">${totalSks(app)} SKS</td>
                <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">${esc(averageScore(app))}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded text-[10px] font-bold uppercase ${badge(app.status)}">${esc(app.status)}</span></td>
                <td class="px-6 py-4 text-xs text-[#5A6478] max-w-xs">${esc(note(app))}</td>
                <td class="px-6 py-4 text-center">
                    <button type="button" data-open-detail="${esc(app.id)}" class="px-4 py-2 bg-[#1565C0] text-white text-[11px] font-bold rounded-lg hover:bg-[#0D47A1]">Lihat Detail</button>
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

    const renderAssessmentDetails = (assessment) => {
        const rows = assessment?.assessment_details || assessment?.assessmentDetails || [];
        if (!rows.length) return '<p class="text-xs text-[#5A6478]">Tidak ada detail konversi SKS. Assessment ini kemungkinan berstatus rejected.</p>';
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
        detailBody.innerHTML = '<p class="text-sm text-[#5A6478]">Memuat detail application...</p>';
        try {
            const { data: app } = await axios.get(`/api/asesor/applications/${id}`);
            const experiences = app.learning_experiences || app.learningExperiences || [];
            const assessment = app.assessments?.[0] || null;

            detailTitle.textContent = app.applicant?.nama || 'Detail Assessment';
            detailSubtitle.textContent = `${app.prodi?.nama_prodi || '-'} | APP-${String(app.id).slice(0, 8).toUpperCase()} | ${app.status}`;
            detailBody.innerHTML = `
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                        <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Dokumen Pendukung</h4>
                        <div class="space-y-3">${renderDocuments(app.documents || [])}</div>
                    </section>
                    <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                        <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Learning Experiences</h4>
                        <div class="space-y-3">${renderExperiences(experiences)}</div>
                    </section>
                </div>
                <section class="border border-[#1565C0]/15 rounded-xl p-5">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4">
                        <div>
                            <h4 class="text-sm font-bold text-[#1A1A2E]">Hasil Assessment</h4>
                            <p class="text-xs text-[#5A6478] mt-1">${esc(assessment?.notes || app.rejection_note || 'Tidak ada catatan.')}</p>
                        </div>
                        <span class="px-3 py-1.5 rounded text-xs font-bold uppercase ${badge(app.status)}">${esc(app.status)}</span>
                    </div>
                    <div class="space-y-3">${renderAssessmentDetails(assessment)}</div>
                </section>
            `;
        } catch (error) {
            detailBody.innerHTML = `<p class="text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat detail assessment.')}</p>`;
        }
    }

    async function loadHistory() {
        try {
            const { data } = await axios.get('/api/asesor/applications');
            applications = data;
            render();
        } catch (error) {
            table.innerHTML = `<tr><td colspan="7" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat riwayat assessment.')}</td></tr>`;
        }
    }

    document.addEventListener('click', (event) => {
        const detailButton = event.target.closest('[data-open-detail]');
        if (detailButton) openDetail(detailButton.dataset.openDetail);
        if (event.target.closest('[data-close-detail]')) detailModal.classList.add('hidden');
    });
    searchInput.addEventListener('input', render);
    loadHistory();
});
</script>

@endsection
