{{-- resources/views/applicant/profile.blade.php --}}
@extends('applicant.layout')
@section('title', 'Profil Data Diri')
@section('applicant_content')

<div class="mb-8">
    <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Profil Data Diri</h1>
    <p class="text-sm text-[#5A6478] mt-1">Dibaca dari endpoint <code>/api/auth/me</code>. Update profil belum tersedia di endpoint BE.</p>
</div>

<div class="bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Informasi Akun</h2>
    </div>
    <div id="profileBox" class="p-6 text-sm text-[#5A6478]">Memuat data...</div>
</div>

<script>
window.addEventListener('load', async () => {
    const box = document.getElementById('profileBox');
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    try {
        const { data } = await axios.get('/api/auth/me');
        box.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div><p class="text-xs font-bold text-[#1A1A2E] mb-2">Nama</p><p>${esc(data.name)}</p></div>
                <div><p class="text-xs font-bold text-[#1A1A2E] mb-2">Email</p><p>${esc(data.email)}</p></div>
                <div><p class="text-xs font-bold text-[#1A1A2E] mb-2">Role</p><p>${esc(data.role)}</p></div>
                <div><p class="text-xs font-bold text-[#1A1A2E] mb-2">Status</p><p>${data.is_active ? 'Aktif' : 'Nonaktif'}</p></div>
            </div>
            <div class="pt-6 mt-6 border-t border-gray-100 flex justify-end">
                <a href="{{ route('applicant.program') }}" class="px-6 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Lanjut Pilih Program</a>
            </div>
        `;
    } catch (error) {
        box.innerHTML = `<p class="text-red-600">${esc(error.response?.data?.message || 'Gagal memuat profil.')}</p>`;
    }
});
</script>

@endsection
