{{-- resources/views/applicant/program.blade.php --}}
@extends('applicant.layout')
@section('title', 'Pilih Tipe RPL & Program Studi')
@section('applicant_content')

<div id="programAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Pilih Tipe RPL & Program Studi</h1>
    <p class="text-sm text-[#5A6478] mt-1">Form ini submit ke endpoint <code>POST /api/applications</code>.</p>
</div>

<form id="programForm" class="space-y-6">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100"><h2 class="font-heading font-bold text-[#1A1A2E]">Tipe Pendaftaran RPL</h2></div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="relative block cursor-pointer">
                <input type="radio" name="jenis_rpl" value="A" class="peer sr-only" checked>
                <div class="border-2 rounded-xl p-6 transition-all peer-checked:border-[#1565C0] peer-checked:bg-blue-50/30 border-gray-200 hover:border-[#1565C0]/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-lg flex-shrink-0">A</div>
                        <div>
                            <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe A</h3>
                            <p class="text-[10px] text-[#5A6478]">Transfer Kredit / Lanjut Studi</p>
                        </div>
                    </div>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Melanjutkan pendidikan formal dengan pengakuan SKS dari pendidikan sebelumnya atau pengalaman kerja.</p>
                </div>
            </label>
            <label class="relative block cursor-pointer">
                <input type="radio" name="jenis_rpl" value="B" class="peer sr-only">
                <div class="border-2 rounded-xl p-6 transition-all peer-checked:border-[#E65100] peer-checked:bg-orange-50/30 border-gray-200 hover:border-[#E65100]/40">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-12 h-12 rounded-full bg-[#FFF8E1] text-[#E65100] flex items-center justify-center font-bold text-lg flex-shrink-0">B</div>
                        <div>
                            <h3 class="font-heading font-bold text-[#1A1A2E]">RPL Tipe B</h3>
                            <p class="text-[10px] text-[#5A6478]">Penyetaraan Kualifikasi</p>
                        </div>
                    </div>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Pengakuan kompetensi untuk penyetaraan kualifikasi berdasarkan pengalaman dan bukti pendukung.</p>
                </div>
            </label>
        </div>
    </div>

    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6">
        <h3 class="text-sm font-bold text-[#1565C0] mb-3">Informasi Penting</h3>
        <ul class="text-xs text-[#5A6478] space-y-2 leading-relaxed">
            <li>Pastikan profil data diri telah benar sebelum memilih program studi.</li>
            <li>Anda hanya dapat memilih satu program studi per pengajuan.</li>
            <li>Application akan berstatus draft sampai dokumen dan learning experience dikirim.</li>
        </ul>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100"><h2 class="font-heading font-bold text-[#1A1A2E]">Program Studi Tujuan</h2></div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Program Studi *</label>
                <select id="prodiSelect" name="prodi_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0]">
                    <option value="">Memuat prodi...</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-2">Konsentrasi (Opsional)</label>
                <select id="konsentrasiSelect" name="konsentrasi_id" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none focus:border-[#1565C0]">
                    <option value="">-- Pilih Konsentrasi --</option>
                </select>
            </div>
        </div>
    </div>

    <div class="flex justify-between pt-4">
        <a href="{{ route('applicant.profile') }}" class="px-6 py-2.5 border border-gray-300 text-[#5A6478] text-sm font-bold rounded-lg hover:bg-gray-50">Kembali</a>
        <button type="submit" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Simpan & Lanjutkan</button>
    </div>
</form>

<script>
window.addEventListener('load', () => {
    const form = document.getElementById('programForm');
    const prodiSelect = document.getElementById('prodiSelect');
    const konsentrasiSelect = document.getElementById('konsentrasiSelect');
    const alertBox = document.getElementById('programAlert');
    let prodis = [];
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };

    async function loadProdis() {
        try {
            const { data } = await axios.get('/api/prodis');
            prodis = data;
            prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>' + prodis.map((prodi) => `<option value="${prodi.id}">${prodi.nama_prodi}</option>`).join('');
        } catch (error) {
            prodiSelect.innerHTML = '<option value="">Gagal memuat prodi</option>';
            showAlert(error.response?.data?.message || 'Gagal memuat /api/prodis.', false);
        }
    }

    prodiSelect.addEventListener('change', () => {
        const prodi = prodis.find((item) => item.id === prodiSelect.value);
        konsentrasiSelect.innerHTML = '<option value="">-- Pilih Konsentrasi --</option>' + (prodi?.konsentrasis || []).map((item) => `<option value="${item.id}">${item.nama_konsentrasi}</option>`).join('');
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const payload = {
            jenis_rpl: new FormData(form).get('jenis_rpl'),
            prodi_id: prodiSelect.value,
            konsentrasi_id: konsentrasiSelect.value || null,
        };
        try {
            await axios.post('/api/applications', payload);
            window.location.href = '{{ route('applicant.documents') }}';
        } catch (error) {
            showAlert(error.response?.data?.message || 'Gagal membuat application.', false);
        }
    });

    loadProdis();
});
</script>

@endsection
