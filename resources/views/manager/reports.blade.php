{{-- resources/views/manager/reports.blade.php --}}
@extends('manager.layout')
@section('page_title', 'Laporan & Statistik')
@section('manager_content')

<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Laporan & Statistik</h2>
        <p class="text-sm text-[#5A6478] mt-1">Ringkasan status application berdasarkan endpoint manager.</p>
    </div>
    <a href="{{ route('manager.applications') }}" class="inline-flex items-center justify-center px-5 py-2.5 border border-[#1565C0]/30 text-[#1565C0] text-sm font-bold rounded-lg hover:bg-[#E3F0FF]">Kelola Pengajuan</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Status Pengajuan</h2>
        <div id="statusChart" class="space-y-4">
            <p class="text-sm text-[#5A6478]">Memuat data...</p>
        </div>
    </div>

    <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
        <h2 class="font-heading font-bold text-[#1A1A2E] mb-6">Ringkasan</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center"><p class="text-[10px] text-[#5A6478] uppercase font-bold">Total</p><p id="reportTotal" class="text-2xl font-extrabold text-[#1565C0] mt-2">0</p></div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center"><p class="text-[10px] text-[#5A6478] uppercase font-bold">Submitted</p><p id="reportSubmitted" class="text-2xl font-extrabold text-blue-600 mt-2">0</p></div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center"><p class="text-[10px] text-[#5A6478] uppercase font-bold">Assigned</p><p id="reportAssigned" class="text-2xl font-extrabold text-purple-600 mt-2">0</p></div>
            <div class="bg-[#F8FAFC] rounded-xl p-4 text-center"><p class="text-[10px] text-[#5A6478] uppercase font-bold">Selesai</p><p id="reportDone" class="text-2xl font-extrabold text-green-600 mt-2">0</p></div>
        </div>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const chart = document.getElementById('statusChart');
    const colors = { submitted: 'bg-blue-500', assigned: 'bg-purple-500', assessed: 'bg-yellow-500', approved: 'bg-green-500', rejected: 'bg-red-500' };
    try {
        const { data } = await axios.get('/api/manager/applications');
        const total = data.length || 1;
        const counts = data.reduce((carry, app) => ({ ...carry, [app.status]: (carry[app.status] || 0) + 1 }), {});
        document.getElementById('reportTotal').textContent = data.length;
        document.getElementById('reportSubmitted').textContent = counts.submitted || 0;
        document.getElementById('reportAssigned').textContent = (counts.assigned || 0) + (counts.assessed || 0);
        document.getElementById('reportDone').textContent = (counts.approved || 0) + (counts.rejected || 0);
        chart.innerHTML = ['submitted', 'assigned', 'assessed', 'approved', 'rejected'].map((status) => {
            const count = counts[status] || 0;
            const percent = Math.round((count / total) * 100);
            return `<div><div class="flex justify-between text-xs font-bold mb-1.5"><span class="text-[#5A6478]">${status}</span><span class="text-[#1A1A2E]">${count} (${percent}%)</span></div><div class="w-full bg-gray-100 rounded-full h-2.5"><div class="h-2.5 rounded-full ${colors[status]}" style="width: ${percent}%"></div></div></div>`;
        }).join('');
    } catch (error) {
        chart.innerHTML = `<p class="text-sm text-red-600">${error.response?.data?.message || 'Gagal memuat laporan dari endpoint.'}</p>`;
    }
});
</script>

@endsection
