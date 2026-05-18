{{-- resources/views/assessor/queue.blade.php --}}
@extends('assessor.layout')
@section('page_title', 'Antrean Penugasan')
@section('assessor_content')

<div id="queueAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Tunggu Asesmen</h2>
            <p class="text-xs text-[#5A6478] mt-1">Assignment dimuat dari endpoint <code>/api/asesor/applications</code>.</p>
        </div>
        <input id="searchInput" type="text" placeholder="Cari mahasiswa..." class="text-xs border border-gray-300 rounded-lg px-4 py-2 w-full sm:w-64 outline-none focus:border-[#1565C0]">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Mahasiswa</th>
                    <th class="px-6 py-4">Prodi Tujuan</th>
                    <th class="px-6 py-4">Tipe RPL</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="queueTable" class="divide-y divide-gray-50">
                <tr><td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div id="assessmentModal" class="fixed inset-0 z-[80] hidden">
    <div class="absolute inset-0 bg-[#1A1A2E]/60" data-close-modal></div>
    <div class="relative max-w-6xl mx-auto my-6 bg-white rounded-xl shadow-2xl max-h-[calc(100vh-48px)] overflow-hidden flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 flex items-start justify-between gap-4">
            <div>
                <h3 id="modalTitle" class="font-heading text-lg font-bold text-[#1A1A2E]">Assessment</h3>
                <p id="modalSubtitle" class="text-xs text-[#5A6478] mt-1">Review dokumen dan learning experiences.</p>
            </div>
            <button type="button" data-close-modal class="w-9 h-9 rounded-lg border border-gray-200 text-[#5A6478] hover:bg-gray-50 font-bold">x</button>
        </div>

        <div id="modalBody" class="overflow-y-auto p-6 space-y-6">
            <p class="text-sm text-[#5A6478]">Memuat detail...</p>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-[#F8FAFC] flex justify-end gap-3">
            <button type="button" data-close-modal class="px-5 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-white">Batal</button>
            <button id="saveAssessmentButton" type="button" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Simpan Assessment</button>
        </div>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const table = document.getElementById('queueTable');
    const searchInput = document.getElementById('searchInput');
    const alertBox = document.getElementById('queueAlert');
    const modal = document.getElementById('assessmentModal');
    const modalBody = document.getElementById('modalBody');
    const modalTitle = document.getElementById('modalTitle');
    const modalSubtitle = document.getElementById('modalSubtitle');
    const saveButton = document.getElementById('saveAssessmentButton');
    let applications = [];
    let activeApplication = null;
    let activeCourses = [];

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };
    const statusBadge = (status) => ({
        assigned: 'bg-yellow-50 text-yellow-700',
        approved: 'bg-green-50 text-green-700',
        rejected: 'bg-red-50 text-red-700',
    }[status] || 'bg-gray-50 text-gray-700');

    function render() {
        const q = searchInput.value.toLowerCase();
        const rows = applications
            .filter((app) => app.status === 'assigned')
            .filter((app) => !q || (app.applicant?.nama || '').toLowerCase().includes(q));

        if (!rows.length) {
            table.innerHTML = '<tr><td colspan="5" class="px-6 py-10 text-center text-sm text-[#5A6478]">Tidak ada assignment yang menunggu assessment.</td></tr>';
            return;
        }

        table.innerHTML = rows.map((app) => `
            <tr class="hover:bg-blue-50/30 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</p>
                    <p class="text-[10px] text-gray-400 font-mono">APP-${esc(app.id).slice(0, 8).toUpperCase()}</p>
                </td>
                <td class="px-6 py-4 text-xs font-medium text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-[#1565C0]">Tipe ${esc(app.jenis_RPL || app.jenis_rpl)}</span></td>
                <td class="px-6 py-4"><span class="px-2 py-1 rounded text-[10px] font-bold ${statusBadge(app.status)}">${esc(app.status)}</span></td>
                <td class="px-6 py-4 text-center">
                    <button type="button" data-open-assessment="${esc(app.id)}" class="px-4 py-2 bg-[#1565C0] text-white text-[11px] font-bold rounded-lg hover:bg-[#0D47A1]">Mulai Penilaian</button>
                </td>
            </tr>
        `).join('');
    }

    function documentRows(documents) {
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
    }

    function experienceRows(experiences) {
        if (!experiences?.length) return '<p class="text-xs text-[#5A6478]">Belum ada learning experience.</p>';
        return experiences.map((item, index) => `
            <div class="border border-gray-100 rounded-lg p-4">
                <p class="text-sm font-bold text-[#1A1A2E]">${index + 1}. ${esc(item.title || item.judul || item.nama_pengalaman)}</p>
                <p class="text-xs text-[#5A6478] mt-1 leading-relaxed">${esc(item.description || item.deskripsi || item.reflection || item.pengalaman)}</p>
            </div>
        `).join('');
    }

    function assessmentRows(experiences) {
        if (!experiences?.length) {
            return '<p class="text-xs text-red-600">Learning experience belum tersedia. Assessment approved membutuhkan minimal satu detail.</p>';
        }

        const courseOptions = activeCourses.map((course) => `<option value="${esc(course.id)}">${esc(course.kode_mk)} - ${esc(course.nama_matkul)} (${esc(course.sks)} SKS)</option>`).join('');
        return experiences.map((item, index) => `
            <div class="assessment-row border border-[#1565C0]/15 rounded-xl p-4 space-y-4" data-learning-experience-id="${esc(item.id)}">
                <div>
                    <p class="text-xs font-bold text-[#1565C0] uppercase tracking-wider">Learning Experience ${index + 1}</p>
                    <p class="text-sm font-bold text-[#1A1A2E] mt-1">${esc(item.title || item.judul || item.nama_pengalaman)}</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div class="lg:col-span-3">
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">Course Existing</label>
                        <select class="course-select w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]">
                            <option value="">Buat course baru</option>
                            ${courseOptions}
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">Kode MK Baru</label>
                        <input class="new-code w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]" placeholder="IF101">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">Nama Matkul Baru</label>
                        <input class="new-name w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]" placeholder="Pemrograman Dasar">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">SKS Course</label>
                        <input type="number" min="1" class="new-sks w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]" placeholder="3">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">SKS Diakui *</label>
                        <input type="number" min="0" class="sks-diakui w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]" required value="0">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-[#1A1A2E] mb-1">Nilai Konversi *</label>
                        <input type="number" min="0" max="100" class="nilai-konversi w-full border border-gray-300 rounded-lg px-3 py-2 text-xs outline-none focus:border-[#1565C0]" required value="0">
                    </div>
                </div>
            </div>
        `).join('');
    }

    function renderModal() {
        const experiences = activeApplication.learning_experiences || activeApplication.learningExperiences || [];
        modalTitle.textContent = activeApplication.applicant?.nama || 'Assessment';
        modalSubtitle.textContent = `${activeApplication.prodi?.nama_prodi || '-'} | APP-${String(activeApplication.id).slice(0, 8).toUpperCase()}`;
        modalBody.innerHTML = `
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                    <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Dokumen Pendukung</h4>
                    <div class="space-y-3">${documentRows(activeApplication.documents || [])}</div>
                </section>
                <section class="bg-[#F8FAFC] border border-gray-100 rounded-xl p-5">
                    <h4 class="text-sm font-bold text-[#1A1A2E] mb-4">Learning Experiences</h4>
                    <div class="space-y-3">${experienceRows(experiences)}</div>
                </section>
            </div>
            <section class="border border-[#1565C0]/15 rounded-xl p-5">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-5">
                    <div>
                        <h4 class="text-sm font-bold text-[#1A1A2E]">Keputusan Assessment</h4>
                        <p class="text-xs text-[#5A6478] mt-1">Approve membutuhkan mapping course, SKS, dan nilai konversi.</p>
                    </div>
                    <select id="assessmentStatus" class="border border-gray-300 rounded-lg px-3 py-2 text-sm font-bold outline-none focus:border-[#1565C0]">
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Catatan</label>
                <textarea id="assessmentNotes" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-3 text-sm outline-none focus:border-[#1565C0]" placeholder="Catatan assessment atau alasan reject"></textarea>
                <div id="approvedFields" class="mt-5 space-y-4">${assessmentRows(experiences)}</div>
            </section>
        `;

        const statusSelect = document.getElementById('assessmentStatus');
        const approvedFields = document.getElementById('approvedFields');
        statusSelect.addEventListener('change', () => {
            approvedFields.classList.toggle('hidden', statusSelect.value === 'rejected');
        });
    }

    async function openAssessment(id) {
        modal.classList.remove('hidden');
        modalBody.innerHTML = '<p class="text-sm text-[#5A6478]">Memuat detail application...</p>';
        saveButton.disabled = true;
        try {
            const [detailRes, coursesRes] = await Promise.all([
                axios.get(`/api/asesor/applications/${id}`),
                axios.get(`/api/asesor/applications/${id}/courses`),
            ]);
            activeApplication = detailRes.data;
            activeCourses = coursesRes.data || [];
            renderModal();
        } catch (error) {
            modalBody.innerHTML = `<p class="text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat detail assessment.')}</p>`;
        } finally {
            saveButton.disabled = false;
        }
    }

    async function saveAssessment() {
        if (!activeApplication) return;
        const status = document.getElementById('assessmentStatus')?.value || 'approved';
        const payload = {
            status,
            notes: document.getElementById('assessmentNotes')?.value || null,
        };

        if (status === 'approved') {
            payload.assessment_details = [...document.querySelectorAll('.assessment-row')].map((row) => {
                const detail = {
                    learning_experience_id: row.dataset.learningExperienceId,
                    sks_diakui: Number(row.querySelector('.sks-diakui').value || 0),
                    nilai_konversi: Number(row.querySelector('.nilai-konversi').value || 0),
                };
                const courseId = row.querySelector('.course-select').value;
                if (courseId) {
                    detail.course_id = courseId;
                } else {
                    detail.new_course = {
                        kode_mk: row.querySelector('.new-code').value,
                        nama_matkul: row.querySelector('.new-name').value,
                        sks: Number(row.querySelector('.new-sks').value || 0),
                    };
                }
                return detail;
            });
        }

        saveButton.disabled = true;
        saveButton.textContent = 'Menyimpan...';
        try {
            await axios.post(`/api/asesor/applications/${activeApplication.id}/assessment`, payload);
            modal.classList.add('hidden');
            showAlert('Assessment berhasil disimpan.');
            await loadApplications();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Gagal menyimpan assessment.', false);
        } finally {
            saveButton.disabled = false;
            saveButton.textContent = 'Simpan Assessment';
        }
    }

    async function loadApplications() {
        try {
            const { data } = await axios.get('/api/asesor/applications');
            applications = data;
            render();
        } catch (error) {
            table.innerHTML = `<tr><td colspan="5" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat endpoint asesor.')}</td></tr>`;
        }
    }

    document.addEventListener('click', (event) => {
        const opener = event.target.closest('[data-open-assessment]');
        if (opener) openAssessment(opener.dataset.openAssessment);
        if (event.target.closest('[data-close-modal]')) modal.classList.add('hidden');
    });
    searchInput.addEventListener('input', render);
    saveButton.addEventListener('click', saveAssessment);
    loadApplications();
});
</script>
@endsection
