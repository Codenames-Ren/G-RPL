{{-- resources/views/applicant/documents.blade.php --}}
@extends('applicant.layout')
@section('title', 'Upload Dokumen Persyaratan')
@section('applicant_content')

<div id="docAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>
<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Upload Dokumen Persyaratan</h1>
    <p class="text-sm text-[#5A6478] mt-1">Data/action via endpoint dokumen applicant.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
        <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
            <form id="uploadForm" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Application</label>
                <select id="applicationSelect" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Tipe Dokumen</label>
                <select id="documentType" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    <option value="ktp">KTP</option>
                    <option value="ijazah">Ijazah</option>
                    <option value="transkrip">Transkrip</option>
                    <option value="cv">CV</option>
                    <option value="surat_kerja">Surat Keterangan Kerja</option>
                    <option value="sertifikat">Sertifikat</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">File</label>
                <input id="documentFile" type="file" required accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm">
            </div>
                <div class="border-2 border-dashed border-[#1565C0]/30 rounded-xl p-6 text-center hover:bg-blue-50/30 transition-colors">
                    <svg class="w-10 h-10 text-[#1565C0]/50 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                    <p class="text-sm font-bold text-[#1565C0]">Pilih file pada input di atas lalu upload</p>
                    <p class="text-xs text-[#5A6478] mt-1">PDF, JPG, PNG maksimal 3MB</p>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Upload Dokumen</button>
            </form>
        </div>
        <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
            <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Dokumen yang Sudah Terupload</h3>
            <div id="documentsList" class="space-y-3 text-sm text-[#5A6478]">Pilih application.</div>
        </div>
    </div>
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h3 class="font-heading font-bold text-[#1A1A2E] mb-4">Status Upload</h3>
        <div id="documentChecklist" class="space-y-3 text-sm text-[#5A6478]">Memuat status...</div>
        <a href="{{ route('applicant.outcomes') }}" class="block mt-6 px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg text-center">Lanjut Learning Outcomes</a>
        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mt-4">
            <h3 class="text-xs font-bold text-[#1565C0] mb-3">Ketentuan Upload</h3>
            <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
                <li>Format: PDF, JPG, PNG.</li>
                <li>Dokumen harus terbaca jelas.</li>
                <li>Minimal satu dokumen diperlukan sebelum submit.</li>
            </ul>
        </div>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const appSelect = document.getElementById('applicationSelect');
    const docsList = document.getElementById('documentsList');
    const checklist = document.getElementById('documentChecklist');
    const docLabels = { ktp: 'KTP', ijazah: 'Ijazah', transkrip: 'Transkrip', cv: 'CV', surat_kerja: 'Surat Kerja', sertifikat: 'Sertifikat' };
    const alertBox = document.getElementById('docAlert');
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };

    async function loadApplications() {
        const { data } = await axios.get('/api/applications');
        appSelect.innerHTML = data.length ? data.map((app) => `<option value="${app.id}">${app.prodi?.nama_prodi || 'Application'} - ${app.status}</option>`).join('') : '<option value="">Belum ada application</option>';
        if (data.length) loadDocuments();
    }

    async function loadDocuments() {
        if (!appSelect.value) return;
        const { data } = await axios.get(`/api/applications/${appSelect.value}/documents`);
        docsList.innerHTML = data.length ? data.map((doc) => `<div class="border border-gray-100 rounded-lg p-3"><p class="text-xs font-bold text-[#1A1A2E]">${doc.type}</p><a class="text-[10px] text-[#1565C0] hover:underline" target="_blank" href="/storage/${doc.file_path}">${doc.file_path}</a></div>`).join('') : 'Belum ada dokumen.';
        checklist.innerHTML = Object.entries(docLabels).map(([type, label]) => {
            const uploaded = data.some((doc) => doc.type === type);
            return `<div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full ${uploaded ? 'bg-green-500' : 'bg-gray-300'}"></span><span class="text-xs flex-grow">${label}</span><span class="text-[10px] font-bold ${uploaded ? 'text-green-600' : 'text-gray-400'}">${uploaded ? 'OK' : '-'}</span></div>`;
        }).join('');
    }

    document.getElementById('uploadForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        const form = new FormData();
        form.append('type', document.getElementById('documentType').value);
        form.append('file', document.getElementById('documentFile').files[0]);
        try {
            await axios.post(`/api/applications/${appSelect.value}/documents`, form, { headers: { 'Content-Type': 'multipart/form-data' } });
            showAlert('Dokumen berhasil diupload.');
            loadDocuments();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Upload gagal.', false);
        }
    });

    appSelect.addEventListener('change', loadDocuments);
    loadApplications().catch((error) => showAlert(error.response?.data?.message || 'Gagal memuat applications.', false));
});
</script>

@endsection
