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
            <form id="uploadForm" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Application</label>
                    <select id="applicationSelect" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm"></select>
                </div>

                <div id="documentFields" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-[#5A6478]">
                    <div class="md:col-span-2 border border-gray-100 rounded-lg p-6 text-center">Pilih application.</div>
                </div>

                <div class="border border-[#1565C0]/15 bg-[#F8FAFC] rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-[#1A1A2E]">Simpan Dokumen</p>
                        <p class="text-xs text-[#5A6478] mt-1">Pilih satu atau beberapa file, lalu simpan sekaligus.</p>
                    </div>
                    <button id="saveDocumentsButton" type="submit" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg">Simpan Dokumen</button>
                </div>
            </form>
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
    const documentFields = document.getElementById('documentFields');
    const checklist = document.getElementById('documentChecklist');
    const uploadForm = document.getElementById('uploadForm');
    const saveButton = document.getElementById('saveDocumentsButton');
    const docLabels = {
        ktp: 'KTP',
        ijazah: 'Ijazah',
        transkrip: 'Transkrip',
        cv: 'CV',
        surat_kerja: 'Surat Keterangan Kerja',
        sertifikat: 'Sertifikat'
    };
    const alertBox = document.getElementById('docAlert');
    const editableStatuses = ['draft', 'rejected'];
    const allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
    const maxFileSize = 3 * 1024 * 1024;
    let applications = [];
    let documentsByType = {};
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
    const storageUrl = (doc) => `/storage/${encodeURIComponent(doc.file_path).replace(/%2F/g, '/')}?v=${encodeURIComponent(doc.updated_at || Date.now())}`;
    const isPreviewableImage = (path) => /\.(png|jpe?g)$/i.test(path || '');
    const validateFile = (file) => {
        const extension = file.name.split('.').pop()?.toLowerCase();
        if (!allowedExtensions.includes(extension)) {
            return `${file.name} harus berformat PDF, JPG, JPEG, atau PNG.`;
        }

        if (file.size > maxFileSize) {
            return `${file.name} melebihi batas 3MB.`;
        }

        return null;
    };
    const setFormDisabled = (disabled) => {
        uploadForm.querySelectorAll('input, select, button').forEach((field) => field.disabled = disabled);
    };
    const latestDocumentsByType = (documents) => documents.reduce((carry, doc) => {
        const current = carry[doc.type];
        if (!current || new Date(doc.created_at || 0) > new Date(current.created_at || 0)) {
            carry[doc.type] = doc;
        }
        return carry;
    }, {});
    const renderDocumentFields = () => {
        documentFields.innerHTML = Object.entries(docLabels).map(([type, label]) => {
            const doc = documentsByType[type];
            const url = doc ? storageUrl(doc) : '';
            return `
                <div class="border border-gray-100 rounded-xl p-4 space-y-3">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <label for="document-${esc(type)}" class="block text-sm font-bold text-[#1A1A2E]">${esc(label)}</label>
                            <p class="text-[10px] text-[#5A6478] mt-1">${doc ? 'Dokumen sudah terupload.' : 'Belum ada dokumen.'}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-[10px] font-bold ${doc ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500'}">${doc ? 'OK' : '-'}</span>
                    </div>
                    ${doc ? `
                        <div class="rounded-lg bg-[#F8FAFC] border border-gray-100 p-3">
                            <p class="text-[10px] font-bold text-[#5A6478] uppercase">File Saat Ini</p>
                            ${isPreviewableImage(doc.file_path) ? `<img src="${esc(url)}" alt="${esc(label)}" class="mt-2 h-28 w-full rounded-lg border border-gray-100 object-cover bg-white">` : ''}
                            <a class="mt-2 block text-[10px] text-[#1565C0] hover:underline break-all" target="_blank" href="${esc(url)}">Lihat file</a>
                        </div>
                    ` : ''}
                    <div>
                        <p class="text-xs font-bold text-[#1A1A2E] mb-2">${doc ? 'Ganti File' : 'Upload File'}</p>
                        <input id="document-${esc(type)}" data-document-input="${esc(type)}" type="file" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-xs">
                    </div>
                </div>
            `;
        }).join('');
    };

    async function loadApplications() {
        const { data } = await axios.get('/api/applications');
        applications = data.filter((app) => editableStatuses.includes(app.status));
        appSelect.innerHTML = applications.length
            ? applications.map((app) => `<option value="${esc(app.id)}">${esc(app.prodi?.nama_prodi || 'Application')} - ${esc(app.status)}</option>`).join('')
            : '<option value="">Tidak ada application draft/rejected</option>';

        if (!applications.length) {
            documentFields.innerHTML = '<div class="md:col-span-2 border border-gray-100 rounded-lg p-6 text-center">Dokumen hanya bisa diubah saat application berstatus draft atau rejected.</div>';
            checklist.textContent = 'Tidak ada application yang bisa diedit.';
            setFormDisabled(true);
            return;
        }

        setFormDisabled(false);
        const rejected = applications.find((app) => app.status === 'rejected');
        if (rejected) appSelect.value = rejected.id;
        loadDocuments();
    }

    async function loadDocuments() {
        if (!appSelect.value) return;
        const app = selectedApplication();
        if (app?.status === 'rejected') {
            showAlert(`Pengajuan direject. Alasan: ${app.rejection_note || 'Tidak ada catatan.'} Silakan ganti/tambah dokumen lalu submit ulang.`, false);
        } else {
            clearAlert();
        }
        const { data } = await axios.get(`/api/applications/${appSelect.value}/documents`);
        documentsByType = latestDocumentsByType(data);
        renderDocumentFields();
        checklist.innerHTML = Object.entries(docLabels).map(([type, label]) => {
            const uploaded = data.some((doc) => doc.type === type);
            return `<div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full ${uploaded ? 'bg-green-500' : 'bg-gray-300'}"></span><span class="text-xs flex-grow">${label}</span><span class="text-[10px] font-bold ${uploaded ? 'text-green-600' : 'text-gray-400'}">${uploaded ? 'OK' : '-'}</span></div>`;
        }).join('');
    }

    uploadForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const selectedFiles = Array.from(document.querySelectorAll('[data-document-input]')).filter((input) => input.files[0]);
        if (!appSelect.value || !selectedFiles.length) {
            showAlert('Pilih minimal satu file dokumen terlebih dahulu.', false);
            return;
        }

        const invalidFileMessage = selectedFiles.map((input) => validateFile(input.files[0])).find(Boolean);
        if (invalidFileMessage) {
            showAlert(invalidFileMessage, false);
            return;
        }

        saveButton.disabled = true;
        saveButton.textContent = 'Menyimpan...';
        try {
            for (const input of selectedFiles) {
                const type = input.dataset.documentInput;
                const form = new FormData();
                form.append('type', type);
                form.append('file', input.files[0]);

                if (documentsByType[type]) {
                    form.append('_method', 'PUT');
                    await axios.post(`/api/documents/${documentsByType[type].id}`, form, { headers: { 'Content-Type': 'multipart/form-data' } });
                } else {
                    await axios.post(`/api/applications/${appSelect.value}/documents`, form, { headers: { 'Content-Type': 'multipart/form-data' } });
                }
            }

            showAlert(`${selectedFiles.length} dokumen berhasil disimpan.`);
            await loadDocuments();
        } catch (error) {
            const errors = error.response?.data?.errors;
            const firstError = errors ? Object.values(errors).flat()[0] : null;
            showAlert(firstError || error.response?.data?.message || 'Gagal menyimpan dokumen.', false);
        } finally {
            saveButton.disabled = false;
            saveButton.textContent = 'Simpan Dokumen';
        }
    });

    appSelect.addEventListener('change', loadDocuments);
    loadApplications().catch((error) => showAlert(error.response?.data?.message || 'Gagal memuat applications.', false));
});
</script>

@endsection
