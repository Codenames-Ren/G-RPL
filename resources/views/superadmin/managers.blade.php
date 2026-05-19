{{-- resources/views/superadmin/managers.blade.php --}}
@extends('superadmin.layout')
@section('page_title', 'Data Manager')
@section('superadmin_content')

<div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="font-heading text-2xl font-bold text-[#1A1A2E]">Data Manager</h2>
        <p class="text-sm text-[#5A6478] mt-1">Daftar akun manager dari endpoint /api/staff.</p>
    </div>
    <a href="{{ route('superadmin.staff') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Tambah Manager</a>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Jabatan</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody id="managerTable" class="divide-y divide-gray-50">
                <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const table = document.getElementById('managerTable');
    try {
        const { data } = await axios.get('/api/staff');
        const managers = data.filter((user) => user.role === 'manager');
        table.innerHTML = managers.length ? managers.map((user) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 text-sm font-bold text-[#1A1A2E]">${esc(user.name)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(user.email)}</td>
                <td class="px-6 py-4 text-xs text-[#5A6478]">${esc(user.rpl_manager?.jabatan)}</td>
                <td class="px-6 py-4 text-xs ${user.is_active ? 'text-green-700' : 'text-red-700'}">${user.is_active ? 'Aktif' : 'Nonaktif'}</td>
            </tr>
        `).join('') : '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Belum ada manager.</td></tr>';
    } catch (error) {
        table.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat manager.')}</td></tr>`;
    }
});
</script>

@endsection
