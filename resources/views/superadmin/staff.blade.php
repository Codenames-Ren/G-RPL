{{-- resources/views/superadmin/staff.blade.php --}}
@extends('superadmin.layout')
@section('page_title', 'Kelola Staff')
@section('superadmin_content')

<div id="staffAlert" class="hidden mb-6 p-4 rounded-xl text-sm font-bold"></div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <section class="xl:col-span-1 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm p-6">
        <h2 class="font-heading font-bold text-[#1A1A2E]">Tambah Staff</h2>
        <p class="text-xs text-[#5A6478] mt-1 mb-5">Membuat akun manager atau asesor melalui /api/staff.</p>

        <form id="staffForm" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Role</label>
                <select id="roleInput" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]">
                    <option value="manager">Manager</option>
                    <option value="asesor">Asesor</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Nama</label>
                <input id="nameInput" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Email</label>
                <input id="emailInput" type="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]" required>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Password</label>
                    <input id="passwordInput" type="password" minlength="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Konfirmasi</label>
                    <input id="passwordConfirmationInput" type="password" minlength="6" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]" required>
                </div>
            </div>
            <div id="managerFields">
                <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Jabatan</label>
                <input id="jabatanInput" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]" placeholder="Manager RPL">
            </div>
            <div id="asesorFields" class="hidden space-y-4">
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1">NIDN</label>
                    <input id="nidnInput" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Bidang Keahlian</label>
                    <input id="bidangInput" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#1A1A2E] mb-1">Prodi</label>
                    <select id="prodiInput" multiple size="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#1565C0]"></select>
                </div>
            </div>
            <button id="saveStaffButton" type="submit" class="w-full px-5 py-2.5 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1]">Simpan Staff</button>
        </form>
    </section>

    <section class="xl:col-span-2 bg-white border border-[#1565C0]/15 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <h2 class="font-heading font-bold text-[#1A1A2E]">Daftar Staff</h2>
                <p class="text-xs text-[#5A6478] mt-0.5">Status akun dapat diaktifkan atau dinonaktifkan.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-[160px_minmax(220px,1fr)] gap-3 w-full lg:w-auto">
                <select id="roleFilter" class="text-xs border border-gray-300 rounded-lg px-4 py-2 w-full outline-none focus:border-[#1565C0]">
                    <option value="">Semua role</option>
                    <option value="manager">Manager</option>
                    <option value="asesor">Asesor</option>
                </select>
                <input id="searchInput" type="text" placeholder="Cari staff..." class="text-xs border border-gray-300 rounded-lg px-4 py-2 w-full lg:w-64 outline-none focus:border-[#1565C0]">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-[#F8FAFC] text-[11px] font-bold text-[#5A6478] uppercase tracking-widest border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Staff</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="staffTable" class="divide-y divide-gray-50">
                    <tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

<script>
window.addEventListener('load', () => {
    const alertBox = document.getElementById('staffAlert');
    const table = document.getElementById('staffTable');
    const searchInput = document.getElementById('searchInput');
    const roleFilter = document.getElementById('roleFilter');
    const form = document.getElementById('staffForm');
    const roleInput = document.getElementById('roleInput');
    const managerFields = document.getElementById('managerFields');
    const asesorFields = document.getElementById('asesorFields');
    const prodiInput = document.getElementById('prodiInput');
    const saveButton = document.getElementById('saveStaffButton');
    let staff = [];

    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const showAlert = (message, ok = true) => {
        alertBox.textContent = message;
        alertBox.className = `mb-6 p-4 rounded-xl text-sm font-bold ${ok ? 'bg-green-50 border border-green-200 text-green-700' : 'bg-red-50 border border-red-200 text-red-700'}`;
    };

    function roleDetail(user) {
        if (user.role === 'manager') return user.rpl_manager?.jabatan || '-';
        if (user.role === 'asesor') return (user.asesor?.prodis || []).map((prodi) => prodi.nama_prodi).join(', ') || user.asesor?.bidang_keahlian || '-';
        return '-';
    }

    function render() {
        const q = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value;
        const rows = staff
            .filter((user) => !selectedRole || user.role === selectedRole)
            .filter((user) => !q || [user.name, user.email, user.role, roleDetail(user)].join(' ').toLowerCase().includes(q));
        table.innerHTML = rows.length ? rows.map((user) => `
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="text-sm font-bold text-[#1A1A2E]">${esc(user.name)}</p>
                    <p class="text-xs text-[#5A6478]">${esc(user.email)}</p>
                    <p class="text-[10px] text-gray-400 mt-1">${esc(roleDetail(user))}</p>
                </td>
                <td class="px-6 py-4 text-xs font-bold text-[#1565C0]">${esc(user.role)}</td>
                <td class="px-6 py-4 text-xs ${user.is_active ? 'text-green-700' : 'text-red-700'}">${user.is_active ? 'Aktif' : 'Nonaktif'}</td>
                <td class="px-6 py-4 text-right">
                    <button type="button" data-toggle-user="${esc(user.id)}" class="px-3 py-2 rounded-lg border border-gray-300 text-[11px] font-bold hover:bg-gray-50">${user.is_active ? 'Nonaktifkan' : 'Aktifkan'}</button>
                </td>
            </tr>
        `).join('') : '<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-[#5A6478]">Staff tidak ditemukan.</td></tr>';
    }

    function syncRoleFields() {
        managerFields.classList.toggle('hidden', roleInput.value !== 'manager');
        asesorFields.classList.toggle('hidden', roleInput.value !== 'asesor');
    }

    async function loadProdis() {
        try {
            const { data } = await axios.get('/api/prodis');
            prodiInput.innerHTML = data.map((prodi) => `<option value="${esc(prodi.id)}">${esc(prodi.nama_prodi)}</option>`).join('');
        } catch (error) {
            prodiInput.innerHTML = '<option value="">Gagal memuat prodi</option>';
        }
    }

    async function loadStaff() {
        try {
            const { data } = await axios.get('/api/staff');
            staff = data;
            render();
        } catch (error) {
            table.innerHTML = `<tr><td colspan="4" class="px-6 py-10 text-center text-sm text-red-600">${esc(error.response?.data?.message || 'Gagal memuat staff.')}</td></tr>`;
        }
    }

    async function createStaff(event) {
        event.preventDefault();
        const role = roleInput.value;
        const payload = {
            role,
            name: document.getElementById('nameInput').value,
            email: document.getElementById('emailInput').value,
            password: document.getElementById('passwordInput').value,
            password_confirmation: document.getElementById('passwordConfirmationInput').value,
        };

        if (role === 'manager') {
            payload.jabatan = document.getElementById('jabatanInput').value;
        } else {
            payload.nidn = document.getElementById('nidnInput').value;
            payload.bidang_keahlian = document.getElementById('bidangInput').value;
            payload.prodi_ids = [...prodiInput.selectedOptions].map((option) => option.value);
        }

        saveButton.disabled = true;
        saveButton.textContent = 'Menyimpan...';
        try {
            await axios.post('/api/staff', payload);
            form.reset();
            syncRoleFields();
            showAlert('Staff berhasil dibuat.');
            await loadStaff();
        } catch (error) {
            const errors = error.response?.data?.errors;
            showAlert(errors ? Object.values(errors).flat().join(' ') : (error.response?.data?.message || 'Gagal membuat staff.'), false);
        } finally {
            saveButton.disabled = false;
            saveButton.textContent = 'Simpan Staff';
        }
    }

    async function toggleUser(id) {
        try {
            await axios.patch(`/api/staff/${id}/switch-status`);
            showAlert('Status staff berhasil diperbarui.');
            await loadStaff();
        } catch (error) {
            showAlert(error.response?.data?.message || 'Gagal mengubah status staff.', false);
        }
    }

    document.addEventListener('click', (event) => {
        const button = event.target.closest('[data-toggle-user]');
        if (button) toggleUser(button.dataset.toggleUser);
    });
    searchInput.addEventListener('input', render);
    roleFilter.addEventListener('change', render);
    roleInput.addEventListener('change', syncRoleFields);
    form.addEventListener('submit', createStaff);
    syncRoleFields();
    loadProdis();
    loadStaff();
});
</script>

@endsection
