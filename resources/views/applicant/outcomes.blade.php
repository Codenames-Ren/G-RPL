{{-- resources/views/applicant/outcomes.blade.php --}}
@extends('applicant.layout')
@section('title', 'Input Capaian Pembelajaran')
@section('applicant_content')

<div id="outcomeAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>
<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Learning Outcomes</h1>
    <p class="text-sm text-[#5A6478] mt-1">Tambah learning experience dan submit lewat endpoint API.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
            <h3 class="text-xs font-bold text-[#1565C0] mb-2">Petunjuk Pengisian</h3>
            <ul class="text-xs text-[#5A6478] space-y-1.5 leading-relaxed">
                <li>Jelaskan pengalaman kerja atau course yang relevan dengan program studi tujuan.</li>
                <li>Sertakan tanggung jawab, pencapaian, dan kompetensi yang diperoleh pada deskripsi.</li>
                <li>Minimal satu pengalaman diperlukan sebelum submit application.</li>
            </ul>
        </div>
        <form id="experienceForm" class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="font-heading font-bold text-[#1A1A2E]">Tambah Learning Experience</h2>
                    <p class="text-xs text-[#5A6478] mt-0.5">Pengalaman kerja, pelatihan, course, atau sertifikasi.</p>
                </div>
                <span class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-bold rounded-full">Wajib</span>
            </div>
            <div class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Application</label>
                <select id="applicationSelect" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></select>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-xs font-bold text-[#1A1A2E] mb-2">Judul</label><input id="experienceTitle" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></div>
                <div><label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tipe</label><select id="experienceType" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"><option value="experience">Experience</option><option value="course">Course</option></select></div>
            </div>
            <div><label class="block text-xs font-bold text-[#1A1A2E] mb-2">Deskripsi</label><textarea id="experienceDescription" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></textarea></div>
            <div class="flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Tambah Experience</button>
            </div>
            </div>
        </form>
        <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="font-heading font-bold text-[#1A1A2E]">Learning Experiences Tersimpan</h2>
            </div>
            <div id="experiencesList" class="divide-y divide-gray-100 text-sm text-[#5A6478]">Pilih application.</div>
        </div>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Review & Submit</h3>
        <p class="text-xs text-[#5A6478] leading-relaxed">Submit akan memanggil endpoint <code>PATCH /api/applications/{id}/submit</code>. Backend akan menolak jika dokumen atau learning experience belum ada.</p>
        <button id="submitButton" type="button" class="w-full mt-6 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Submit Application</button>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const appSelect = document.getElementById('applicationSelect');
    const list = document.getElementById('experiencesList');
    const alertBox = document.getElementById('outcomeAlert');
    const editableStatuses = ['draft', 'rejected'];
    let applications = [];
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };
    const clearAlert = () => {
        alertBox.textContent = '';
        alertBox.className = 'hidden mb-6 p-4 rounded-xl text-sm font-bold';
    };
    const selectedApplication = () => applications.find((app) => String(app.id) === String(appSelect.value));

    async function loadApplications() {
        const { data } = await axios.get('/api/applications');
        applications = data.filter((app) => editableStatuses.includes(app.status));
        appSelect.innerHTML = applications.length
            ? applications.map((app) => `<option value="${esc(app.id)}">${esc(app.prodi?.nama_prodi || 'Application')} - ${esc(app.status)}</option>`).join('')
            : '<option value="">Tidak ada application draft/rejected</option>';

        if (!applications.length) {
            list.innerHTML = '<div class="p-8 text-center text-sm text-[#5A6478]">Learning experience hanya bisa diubah saat application berstatus draft atau rejected.</div>';
            document.getElementById('experienceForm').querySelectorAll('input, textarea, select, button').forEach((field) => field.disabled = true);
            document.getElementById('submitButton').disabled = true;
            document.getElementById('submitButton').className = 'w-full mt-6 px-5 py-2.5 bg-gray-200 text-gray-400 text-sm font-bold rounded-lg cursor-not-allowed';
            return;
        }

        document.getElementById('experienceForm').querySelectorAll('input, textarea, select, button').forEach((field) => field.disabled = false);
        document.getElementById('submitButton').disabled = false;
        document.getElementById('submitButton').className = 'w-full mt-6 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg';
        const rejected = applications.find((app) => app.status === 'rejected');
        if (rejected) appSelect.value = rejected.id;
        loadExperiences();
    }

    async function loadExperiences() {
        if (!appSelect.value) return;
        const app = selectedApplication();
        if (app?.status === 'rejected') {
            showAlert(`Pengajuan direject. Alasan: ${app.rejection_note || 'Tidak ada catatan.'} Silakan perbaiki learning experience lalu submit ulang.`, false);
        } else {
            clearAlert();
        }
        const { data } = await axios.get(`/api/applications/${appSelect.value}/learning-experiences`);
        list.innerHTML = data.length ? data.map((item) => `
            <form data-experience-id="${esc(item.id)}" class="p-6 space-y-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-[#1A1A2E]">${esc(item.title)}</p>
                        <span class="inline-flex mt-2 px-2 py-1 bg-blue-50 text-[#1565C0] text-[10px] font-bold rounded-full">${esc(item.type)}</span>
                    </div>
                    <span class="text-[10px] font-bold text-[#5A6478]">PUT /api/learning-experiences/${esc(item.id).slice(0, 8)}</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="title" required value="${esc(item.title)}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    <select name="type" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                        <option value="experience" ${item.type === 'experience' ? 'selected' : ''}>Experience</option>
                        <option value="course" ${item.type === 'course' ? 'selected' : ''}>Course</option>
                    </select>
                </div>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">${esc(item.description || '')}</textarea>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-[#1565C0] text-white text-xs font-bold rounded-lg">Simpan Perubahan</button>
                </div>
            </form>
        `).join('') : '<div class="p-8 text-center text-sm text-[#5A6478]">Belum ada learning experience.</div>';
    }
    document.getElementById('experienceForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        try {
            await axios.post(`/api/applications/${appSelect.value}/learning-experiences`, {
                title: document.getElementById('experienceTitle').value,
                type: document.getElementById('experienceType').value,
                description: document.getElementById('experienceDescription').value,
            });
            showAlert('Learning experience berhasil ditambahkan.');
            loadExperiences();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Gagal menambah experience.', false);
        }
    });
    list.addEventListener('submit', async (event) => {
        const editForm = event.target.closest('[data-experience-id]');
        if (!editForm) return;
        event.preventDefault();
        try {
            await axios.put(`/api/learning-experiences/${editForm.dataset.experienceId}`, {
                title: editForm.querySelector('[name="title"]').value,
                type: editForm.querySelector('[name="type"]').value,
                description: editForm.querySelector('[name="description"]').value,
            });
            showAlert('Learning experience berhasil diupdate.');
            loadExperiences();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Gagal update experience.', false);
        }
    });
    document.getElementById('submitButton').addEventListener('click', async () => {
        if (!appSelect.value) return;
        try {
            await axios.patch(`/api/applications/${appSelect.value}/submit`);
            showAlert('Application submitted successfully.');
            loadApplications();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Submit gagal.', false);
        }
    });
    appSelect.addEventListener('change', loadExperiences);
    loadApplications().catch((error) => showAlert(error.response?.data?.message || 'Gagal memuat applications.', false));
});
</script>

@endsection
