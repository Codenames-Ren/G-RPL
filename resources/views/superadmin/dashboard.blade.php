{{-- resources/views/superadmin/dashboard.blade.php --}}
@extends('superadmin.layout')
@section('page_title', 'Dashboard Superadmin')
@section('superadmin_content')

<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Ringkasan Staff</h2>
        <p class="text-sm text-[#5A6478] mt-1">Pantau akun manager dan asesor yang dipakai dalam flow G-RPL.</p>
    </div>
    <a href="{{ route('superadmin.staff') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Kelola Staff</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @foreach([
        ['id' => 'totalStaff', 'label' => 'Total Staff', 'color' => 'text-[#1A1A2E]'],
        ['id' => 'totalManager', 'label' => 'Manager', 'color' => 'text-[#1565C0]'],
        ['id' => 'totalAsesor', 'label' => 'Asesor', 'color' => 'text-purple-600'],
        ['id' => 'activeStaff', 'label' => 'Aktif', 'color' => 'text-green-600'],
    ] as $card)
        <div class="bg-white border border-[#1565C0]/15 rounded-xl p-6 shadow-sm">
            <p class="text-xs font-bold text-[#5A6478] uppercase tracking-wider">{{ $card['label'] }}</p>
            <h3 id="{{ $card['id'] }}" class="font-heading text-3xl font-extrabold {{ $card['color'] }} mt-4">0</h3>
            <p class="text-[10px] text-[#5A6478] mt-1">Live dari /api/staff</p>
        </div>
    @endforeach
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="font-heading font-bold text-[#1A1A2E]">Staff Terbaru</h2>
            <p class="text-xs text-[#5A6478] mt-0.5">Akun selain superadmin.</p>
        </div>
        <a href="{{ route('superadmin.staff') }}" class="text-xs font-bold text-[#1565C0] hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody id="latestStaff" class="divide-y divide-gray-50">
                <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const tbody = document.getElementById('latestStaff');
    try {
        const { data } = await axios.get('/api/staff');
        document.getElementById('totalStaff').textContent = data.length;
        document.getElementById('totalManager').textContent = data.filter((user) => user.role === 'manager').length;
        document.getElementById('totalAsesor').textContent = data.filter((user) => user.role === 'asesor').length;
        document.getElementById('activeStaff').textContent = data.filter((user) => Boolean(user.is_active)).length;
        const latest = data.slice(0, 8);
        tbody.innerHTML = latest.length ? latest.map((user) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">${esc(user.name)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(user.email)}</td>
                <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">${esc(user.role)}</td>
                <td class="px-6 py-4 text-xs ${user.is_active ? 'text-green-700' : 'text-red-700'}">${user.is_active ? 'Aktif' : 'Nonaktif'}</td>
            </tr>
        `).join('') : '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada staff.</td></tr>';
    } catch (error) {
        tbody.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat staff.')}</td></tr>`;
    }
});
</script>

@endsection
