{{-- resources/views/manager/asesors.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Data Asesor')
@section('manager_content')

<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Data Asesor</h2>
        <p class="text-sm text-[#5A6478] mt-1">Pilih application untuk melihat asesor yang sesuai dengan prodi pengajuan.</p>
    </div>
    <a href="{{ route('manager.assignment') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Assign Asesor</a>
</div>

<div id="asesorAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 grid grid-cols-1 lg:grid-cols-3 gap-4 lg:items-end">
        <div class="lg:col-span-2">
            <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Application</label>
            <select id="applicationSelect" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0]">
                <option value="">Memuat application...</option>
            </select>
        </div>
        <button id="loadAsesorButton" type="button" class="px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Tampilkan Asesor</button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">NIDN</th>
                    <th class="px-6 py-4">Bidang Keahlian</th>
                    <th class="px-6 py-4">Prodi Terkait</th>
                </tr>
            </thead>
            <tbody id="asesorTable" class="divide-y divide-gray-50">
                <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Pilih application terlebih dahulu.</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
window.addEventListener('load', () => {
    const appSelect = document.getElementById('applicationSelect');
    const loadButton = document.getElementById('loadAsesorButton');
    const table = document.getElementById('asesorTable');
    const alertBox = document.getElementById('asesorAlert');
    let applications = [];

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };

    function renderApplications() {
        if (!applications.length) {
            appSelect.innerHTML = '<option value="">Tidak ada application</option>';
            return;
        }

        appSelect.innerHTML = '<option value="">-- Pilih Application --</option>' + applications.map((app) => `
            <option value="${esc(app.id)}">${esc(app.applicant?.nama)} - ${esc(app.prodi?.nama_prodi)} (${esc(app.status)})</option>
        `).join('');
    }

    function renderAsesors(asesors) {
        if (!asesors.length) {
            table.innerHTML = '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada asesor yang sesuai prodi application ini.</td></tr>';
            return;
        }

        table.innerHTML = asesors.map((asesor) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-[#1A1A2E]">${esc(asesor.nama)}</p>
                    <p class="text-[10px] text-gray-400 font-mono">ASR-${esc(asesor.id).slice(0, 8).toUpperCase()}</p>
                </td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(asesor.nidn)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(asesor.bidang_keahlian)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${(asesor.prodis || []).map((prodi) => esc(prodi.nama_prodi)).join(', ') || '-'}</td>
            </tr>
        `).join('');
    }

    async function loadApplications() {
        try {
            const { data } = await axios.get('/api/manager/applications');
            applications = data;
            renderApplications();
        } catch (error) {
            appSelect.innerHTML = '<option value="">Gagal memuat application</option>';
            showAlert(error.response?.data?.message || 'Gagal memuat endpoint manager applications.', false);
        }
    }

    async function loadAsesors() {
        if (!appSelect.value) {
            showAlert('Pilih application terlebih dahulu.', false);
            return;
        }

        table.innerHTML = '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat asesor...</td></tr>';
        try {
            const { data } = await axios.get(`/api/manager/applications/${appSelect.value}/asesors`);
            renderAsesors(data);
        } catch (error) {
            table.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat asesor.')}</td></tr>`;
        }
    }

    loadButton.addEventListener('click', loadAsesors);
    appSelect.addEventListener('change', () => {
        table.innerHTML = '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Klik Tampilkan Asesor untuk memuat data.</td></tr>';
    });
    loadApplications();
});
</script>

@endsection
