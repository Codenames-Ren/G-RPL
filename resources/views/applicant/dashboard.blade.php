{{-- resources/views/applicant/dashboard.blade.php --}}
@extends('layouts.app')
@section('title', 'Dashboard Calon Mahasiswa')
@section('content')

<nav class="bg-white border-b border-[#1565C0]/15 px-7 h-16 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center gap-2.5">
        <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
        <span class="font-heading font-bold text-[#1565C0] text-lg">G-RPL</span>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden md:block text-right">
            <p id="navUserName" class="text-sm font-bold text-[#1A1A2E]">Calon Mahasiswa</p>
            <p class="text-xs text-[#5A6478]">Applicant</p>
        </div>
        <div id="navInitials" class="w-10 h-10 rounded-full bg-[#E3F0FF] text-[#1565C0] flex items-center justify-center font-bold border border-[#1565C0]/20">CM</div>
        <form method="POST" action="{{ route('logout') }}" class="ml-2">
            @csrf
            <button type="submit" class="p-2 text-[#D32F2F] hover:bg-red-50 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            </button>
        </form>
    </div>
</nav>

<div class="min-h-[calc(100vh-64px)] bg-[#F5F6FA] py-8 px-4 md:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="font-heading text-2xl font-bold text-[#1A1A2E]">Dashboard Pendaftaran</h1>
            <p class="text-sm text-[#5A6478] mt-1">Lengkapi data dan pantau status pengajuan Rekognisi Pembelajaran Lampau Anda.</p>
        </div>

        <div id="statusNotice" class="bg-[#FFF8E1] border border-[#F9A825] rounded-lg p-4 mb-8 flex items-start gap-4 shadow-sm">
            <div class="text-[#F9A825] mt-0.5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"></path></svg>
            </div>
            <div>
                <h3 id="noticeTitle" class="text-sm font-bold text-[#1A1A2E]">Memuat status...</h3>
                <p id="noticeText" class="text-xs text-[#5A6478] mt-1">Mengambil data dari endpoint applicant.</p>
            </div>
        </div>

        <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 mb-8 shadow-sm">
            <h2 class="text-sm font-bold text-[#1A1A2E] mb-6 uppercase tracking-wider">Status Pengajuan</h2>
            <div class="relative flex justify-between items-start w-full">
                <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 rounded-full"></div>
                <div id="activeLine" class="absolute top-5 left-0 h-1 bg-[#1565C0] rounded-full transition-all" style="width: 0%;"></div>

                @foreach(['Draft', 'Submitted', 'Assigned', 'Assessed', 'Keputusan'] as $label)
                <div class="relative flex flex-col items-center gap-2 bg-white px-1">
                    <div data-step-dot="{{ strtolower($label === 'Keputusan' ? 'approved' : $label) }}" class="w-10 h-10 rounded-full flex items-center justify-center border-2 bg-white border-gray-300 text-gray-400">
                        <span class="text-xs font-bold">{{ $loop->iteration }}</span>
                    </div>
                    <span data-step-label="{{ strtolower($label === 'Keputusan' ? 'approved' : $label) }}" class="text-[11px] font-bold text-gray-400">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <h2 class="text-sm font-bold text-[#1A1A2E] mb-4 uppercase tracking-wider">Tahapan Pengajuan Anda</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach([
                    ['key' => 'profile', 'title' => '1. Kelola Profil Data Diri', 'desc' => 'Lengkapi data identitas dan kontak applicant.', 'route' => route('applicant.profile'), 'button' => 'Edit Profil'],
                    ['key' => 'program', 'title' => '2. Pilih Tipe RPL & Program Studi', 'desc' => 'Pilih tipe pendaftaran dan program studi tujuan.', 'route' => route('applicant.program'), 'button' => 'Isi Formulir'],
                    ['key' => 'documents', 'title' => '3. Upload Dokumen Persyaratan', 'desc' => 'Upload KTP, ijazah, CV, sertifikat, dan dokumen pendukung.', 'route' => route('applicant.documents'), 'button' => 'Mulai Upload'],
                    ['key' => 'experiences', 'title' => '4. Input Capaian Pembelajaran', 'desc' => 'Tambahkan pengalaman kerja, course, atau pelatihan.', 'route' => route('applicant.outcomes'), 'button' => 'Input Data'],
                ] as $step)
                <div id="step-{{ $step['key'] }}" class="bg-white border border-[#1565C0]/15 rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between shadow-sm gap-4">
                    <div class="flex items-start sm:items-center gap-4">
                        <div class="step-marker w-8 h-8 rounded-full bg-gray-100 text-gray-400 font-bold text-xs flex items-center justify-center flex-shrink-0">{{ $loop->iteration }}</div>
                        <div>
                            <h3 class="text-sm font-bold text-[#1A1A2E]">{{ $step['title'] }}</h3>
                            <p class="text-xs text-[#5A6478]">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    <a href="{{ $step['route'] }}" class="px-4 py-2 bg-[#1565C0] text-white text-xs font-bold rounded-lg hover:bg-[#0D47A1] transition-colors whitespace-nowrap text-center">{{ $step['button'] }}</a>
                </div>
                @endforeach
            </div>

            <div class="space-y-4">
                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-6 text-center shadow-sm">
                    <div class="w-12 h-12 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="font-heading font-bold text-[#1A1A2E] text-lg mb-2">Submit Application</h3>
                    <p class="text-xs text-[#5A6478] mb-6 leading-relaxed">Anda dapat mengirimkan pengajuan jika dokumen dan learning experience sudah terisi.</p>
                    <button id="submitApplicationButton" disabled class="w-full py-3 bg-gray-200 text-gray-400 text-sm font-bold rounded-lg cursor-not-allowed transition-colors">Kirim Pengajuan</button>
                </div>

                <div class="bg-white border border-[#1565C0]/15 rounded-lg p-5 shadow-sm">
                    <h3 class="text-xs font-bold text-[#1A1A2E] mb-3 uppercase">Application Terbaru</h3>
                    <div id="applicationsList" class="space-y-3 text-sm text-[#5A6478]">Memuat data...</div>
                </div>

                <div class="bg-blue-50 border border-blue-100 rounded-lg p-5">
                    <h3 class="text-xs font-bold text-[#1565C0] mb-2">Pusat Bantuan</h3>
                    <p class="text-xs text-[#5A6478] leading-relaxed">Jika mengalami kendala upload dokumen atau input pengalaman, hubungi admin kampus.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
window.addEventListener('load', async () => {
    const esc = (value) => String(value ?? '-').replace(/[&<>"']/g, (char) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[char]));
    const statusOrder = ['draft', 'submitted', 'assigned', 'assessed', 'approved'];
    let latestApplication = null;

    const initials = (name) => (name || 'CM').split(' ').filter(Boolean).slice(0, 2).map((part) => part[0]).join('').toUpperCase();
    const setStepDone = (key, done) => {
        const card = document.getElementById(`step-${key}`);
        if (!card) return;
        const marker = card.querySelector('.step-marker');
        card.classList.toggle('border-green-200', done);
        marker.className = `step-marker w-8 h-8 rounded-full font-bold text-xs flex items-center justify-center flex-shrink-0 ${done ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-400'}`;
        marker.textContent = done ? 'OK' : marker.textContent;
    };
    const updateStatusTrack = (status) => {
        const index = Math.max(statusOrder.indexOf(status), 0);
        document.getElementById('activeLine').style.width = `${Math.min(index * 25, 100)}%`;
        statusOrder.forEach((step, stepIndex) => {
            const done = stepIndex <= index && !['rejected', 'cancelled'].includes(status);
            const dot = document.querySelector(`[data-step-dot="${step}"]`);
            const label = document.querySelector(`[data-step-label="${step}"]`);
            if (dot) dot.className = `w-10 h-10 rounded-full flex items-center justify-center border-2 ${done ? 'bg-[#1565C0] border-[#1565C0] text-white' : 'bg-white border-gray-300 text-gray-400'}`;
            if (label) label.className = `text-[11px] font-bold ${done ? 'text-[#1565C0]' : 'text-gray-400'}`;
        });
    };

    try {
        const [meRes, appsRes] = await Promise.all([axios.get('/api/auth/me'), axios.get('/api/applications')]);
        document.getElementById('navUserName').textContent = meRes.data.name || 'Calon Mahasiswa';
        document.getElementById('navInitials').textContent = initials(meRes.data.name);

        const apps = appsRes.data;
        latestApplication = apps[0] || null;
        const status = latestApplication?.status || 'draft';
        updateStatusTrack(status);

        document.getElementById('noticeTitle').textContent = latestApplication ? `Status: ${status}` : 'Status: Belum Ada Pengajuan';
        document.getElementById('noticeText').textContent = latestApplication
            ? (status === 'rejected'
                ? `Pengajuan direject. Alasan: ${latestApplication.rejection_note || 'Tidak ada catatan.'} Silakan perbaiki data lalu submit ulang.`
                : (status === 'submitted' ? 'Pengajuan sudah dikirim dan menunggu assignment manager.' : 'Pantau dan lengkapi tahapan pengajuan Anda.'))
            : 'Anda belum membuat application. Silakan mulai dari tahap pilih program.';

        setStepDone('profile', true);
        setStepDone('program', Boolean(latestApplication));
        setStepDone('documents', Boolean(latestApplication?.documents?.length));
        setStepDone('experiences', Boolean(latestApplication?.learning_experiences?.length || latestApplication?.learningExperiences?.length));

        document.getElementById('applicationsList').innerHTML = apps.length ? apps.map((app) => `
            <div class="border border-gray-100 rounded-lg p-3">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-xs font-bold text-[#1A1A2E]">${esc(app.prodi?.nama_prodi)}</p>
                    <span class="px-2 py-1 rounded text-[10px] font-bold bg-blue-50 text-blue-700">${esc(app.status)}</span>
                </div>
                <p class="text-[10px] text-[#5A6478] mt-1">Tipe ${esc(app.jenis_RPL || app.jenis_rpl)} | APP-${esc(app.id).slice(0, 8).toUpperCase()}</p>
                ${app.status === 'rejected' ? `<p class="text-[10px] text-red-600 mt-2">Alasan: ${esc(app.rejection_note || 'Tidak ada catatan.')}</p>` : ''}
            </div>
        `).join('') : '<p class="text-xs text-[#5A6478]">Belum ada application.</p>';

        const submitButton = document.getElementById('submitApplicationButton');
        if (latestApplication && ['draft', 'rejected'].includes(latestApplication.status)) {
            submitButton.disabled = false;
            submitButton.className = 'w-full py-3 bg-[#1565C0] text-white text-sm font-bold rounded-lg hover:bg-[#0D47A1] transition-colors';
            submitButton.addEventListener('click', async () => {
                await axios.patch(`/api/applications/${latestApplication.id}/submit`);
                window.location.reload();
            });
        }
    } catch (error) {
        document.getElementById('noticeTitle').textContent = 'Gagal memuat data';
        document.getElementById('noticeText').textContent = error.response?.data?.message || 'Endpoint applicant tidak dapat diakses.';
    }
});
</script>
@endsection
