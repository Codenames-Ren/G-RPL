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
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };
    async function loadApplications() {
        const { data } = await axios.get('/api/applications');
        appSelect.innerHTML = data.length ? data.map((app) => `<option value="${app.id}">${app.prodi?.nama_prodi || 'Application'} - ${app.status}</option>`).join('') : '<option value="">Belum ada application</option>';
        if (data.length) loadExperiences();
    }
    async function loadExperiences() {
        if (!appSelect.value) return;
        const { data } = await axios.get(`/api/applications/${appSelect.value}/learning-experiences`);
        list.innerHTML = data.length ? data.map((item) => `<div class="p-6"><div class="flex items-start justify-between gap-4"><div><p class="text-sm font-bold text-[#1A1A2E]">${item.title}</p><span class="inline-flex mt-2 px-2 py-1 bg-blue-50 text-[#1565C0] text-[10px] font-bold rounded-full">${item.type}</span></div></div><p class="mt-3 text-xs text-[#5A6478] leading-relaxed">${item.description || 'Tidak ada deskripsi.'}</p></div>`).join('') : '<div class="p-8 text-center text-sm text-[#5A6478]">Belum ada learning experience.</div>';
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
    document.getElementById('submitButton').addEventListener('click', async () => {
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
