{{-- resources/views/applicant/status.blade.php --}}
@extends('applicant.layout')
@section('title', 'Status Pengajuan')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Status Pengajuan</h1>
    <p class="text-sm text-[#5A6478] mt-1">Status dimuat dari endpoint <code>GET /api/applications</code>.</p>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
    <div id="statusList" class="space-y-4 text-sm text-[#5A6478]">Memuat data...</div>
</div>

<script>
window.addEventListener('load', async () => {
    const list = document.getElementById('statusList');
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    try {
        const { data } = await axios.get('/api/applications');
        list.innerHTML = data.length ? data.map((app) => `
            <div class="border border-gray-100 rounded-xl p-4">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-[#1A1A2E]">${esc(app.prodi?.nama_prodi)}</p>
                        <p class="text-xs text-[#5A6478] mt-1">APP-${esc(app.id).slice(0, 8).toUpperCase()} | Tipe ${esc(app.jenis_RPL || app.jenis_rpl)}</p>
                    </div>
                    <span class="px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-50 text-blue-700">${esc(app.status)}</span>
                </div>
                <p class="text-xs text-[#5A6478] mt-3">${app.status === 'submitted' ? 'Menunggu assignment manager.' : app.status === 'assigned' ? 'Menunggu assessment asesor.' : 'Pantau status pengajuan di sini.'}</p>
            </div>
        `).join('') : 'Belum ada application.';
    } catch (error) {
        list.innerHTML = `<p class="text-red-600">${esc(error.response?.data?.message || 'Gagal memuat status.')}</p>`;
    }
});
</script>

@endsection
