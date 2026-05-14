{{-- resources/views/manager/dashboard.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Dashboard Manajer RPL')
@section('manager_content')

<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Ringkasan Manager</h2>
            <p class="text-sm text-[#5A6478] mt-1">Pantau pengajuan yang sudah masuk dan segera assign asesor untuk application submitted.</p>
        </div>
        <a href="{{ route('manager.assignment') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors">Assign Asesor</a>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @foreach([
        ['id' => 'totalApplications', 'label' => 'Total Pengajuan', 'color' => 'text-[#1A1A2E]'],
        ['id' => 'submittedApplications', 'label' => 'Menunggu Assign', 'color' => 'text-[#F9A825]'],
        ['id' => 'assignedApplications', 'label' => 'Sedang Dinilai', 'color' => 'text-purple-600'],
        ['id' => 'completedApplications', 'label' => 'Selesai', 'color' => 'text-green-600'],
    ] as $card)
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">{{ $card['label'] }}</p>
                <span class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold text-xs">{{ $loop->iteration }}</span>
            </div>
            <h3 id="{{ $card['id'] }}" class="font-heading text-3xl font-extrabold {{ $card['color'] }}">0</h3>
            <p class="text-[10px] text-[#5A6478] mt-1">Live dari endpoint manager</p>
        </div>
    @endforeach
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Pengajuan Terbaru</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">Data endpoint manager.</p>
            </div>
            <a href="{{ route('manager.applications') }}" class="text-xs font-bold text-[#1565C0] hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Applicant</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="latestApplications" class="divide-y divide-gray-50">
                    <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="space-y-6">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-4">Aksi Cepat</h2>
        <div class="space-y-3">
            <a href="{{ route('manager.applications') }}" class="flex items-center justify-between p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] text-sm font-bold text-[#5A6478] transition-colors"><span>Review Pengajuan Baru</span><span class="text-[#1565C0]">→</span></a>
            <a href="{{ route('manager.assignment') }}" class="flex items-center justify-between p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] text-sm font-bold text-[#5A6478] transition-colors"><span>Assign Asesor</span><span class="text-[#1565C0]">→</span></a>
            <a href="{{ route('manager.reports') }}" class="flex items-center justify-between p-3 bg-[#F8FAFC] rounded-lg hover:bg-[#E3F0FF] text-sm font-bold text-[#5A6478] transition-colors"><span>Lihat Laporan</span><span class="text-[#1565C0]">→</span></a>
        </div>
    </div>
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
        <h3 class="text-xs font-bold text-[#1565C0] mb-2">Alur Manager</h3>
        <p class="text-xs text-[#5A6478] leading-relaxed">Lihat application submitted, pilih application, pilih asesor sesuai prodi, lalu backend membuat assignment dan mengubah status menjadi assigned.</p>
    </div>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const tbody = document.getElementById('latestApplications');
    try {
        const { data } = await axios.get('/api/manager/applications');
        document.getElementById('totalApplications').textContent = data.length;
        document.getElementById('submittedApplications').textContent = data.filter((app) => app.status === 'submitted').length;
        document.getElementById('assignedApplications').textContent = data.filter((app) => ['assigned', 'assessed'].includes(app.status)).length;
        document.getElementById('completedApplications').textContent = data.filter((app) => ['approved', 'rejected'].includes(app.status)).length;
        const latest = data.slice(0, 5);
        tbody.innerHTML = latest.length ? latest.map((app) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">${esc(app.applicant?.nama)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.prodi?.nama_prodi)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(app.status)}</td>
                <td class="px-6 py-4"><a href="{{ route('manager.assignment') }}" class="text-xs font-bold text-[#1565C0] hover:underline">${app.status === 'submitted' ? 'Assign' : 'Review'}</a></td>
            </tr>
        `).join('') : '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada pengajuan.</td></tr>';
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat endpoint manager.')}</td></tr>`;
    }
});
</script>

@endsection
