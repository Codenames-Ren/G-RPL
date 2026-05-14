{{-- resources/views/applicant/layout.blade.php --}}
@extends('layouts.app')

@section('content')

@php
    $applicantUser = Auth::user();
    $applicantName = $applicantUser?->applicant?->nama ?? $applicantUser?->name ?? 'Calon Mahasiswa';
    $applicantInitials = str($applicantName)->explode(' ')->filter()->map(fn ($part) => str($part)->substr(0, 1))->take(2)->join('');
    $currentApplication = $application ?? null;
    $currentStatus = $currentApplication?->status ?? 'draft';
@endphp

<div class="flex min-h-screen bg-[#F5F6FA]" x-data="{ sidebarOpen: false }">
    
    {{-- Sidebar Mobile Overlay --}}
    <div x-show="sidebarOpen" class="fixed inset-0 z-50 bg-black/50 md:hidden" @click="sidebarOpen = false" style="display: none;"></div>

    {{-- Sidebar --}}
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-[#1565C0]/15 flex flex-col transition-transform duration-300 md:relative md:translate-x-0 md:flex shadow-sm">
        
        <div class="p-6 border-b border-[#1565C0]/10 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <img src="{{ asset('images/logo.png') }}" alt="G-RPL" class="h-8 w-auto">
                <span class="font-heading font-bold text-[#1565C0] text-xl">G-RPL</span>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        {{-- Progress Steps Navigation --}}
        <div class="p-4 border-b border-[#1565C0]/10">
            <p class="text-[10px] font-bold text-[#5A6478] uppercase tracking-wider mb-3">Proses Pendaftaran</p>
            <div class="space-y-1">
                <a href="{{ route('applicant.profile') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('applicant.profile') ? 'bg-green-50 text-green-700' : 'text-[#5A6478] hover:bg-gray-50' }}">
                    <span class="w-5 h-5 rounded-full {{ Route::is('applicant.profile') ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-[10px] font-bold flex-shrink-0">
                        @if(Route::is('applicant.profile'))
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        @else
                            1
                        @endif
                    </span>
                    Profil Data Diri
                </a>
                <a href="{{ route('applicant.program') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('applicant.program') ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-[#5A6478] hover:bg-gray-50' }}">
                    <span class="w-5 h-5 rounded-full {{ Route::is('applicant.program') ? 'bg-[#1565C0] text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center text-[10px] font-bold flex-shrink-0">2</span>
                    Pilih Program
                </a>
                <a href="{{ route('applicant.documents') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('applicant.documents') ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-gray-400' }}">
                    <span class="w-5 h-5 rounded-full {{ Route::is('applicant.documents') ? 'bg-[#1565C0] text-white' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center text-[10px] font-bold flex-shrink-0">3</span>
                    Upload Dokumen
                </a>
                <a href="{{ route('applicant.outcomes') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('applicant.outcomes') ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-gray-400' }}">
                    <span class="w-5 h-5 rounded-full {{ Route::is('applicant.outcomes') ? 'bg-[#1565C0] text-white' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center text-[10px] font-bold flex-shrink-0">4</span>
                    Learning Outcomes
                </a>
            </div>
        </div>
        
        {{-- Navigasi Utama --}}
        <nav class="flex-grow p-4 space-y-1.5">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('dashboard') ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-[#5A6478] hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('applicant.status') }}" 
               class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-bold text-sm transition-colors {{ Route::is('applicant.status') ? 'bg-[#E3F0FF] text-[#1565C0]' : 'text-[#5A6478] hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Lihat Status
            </a>
        </nav>

        {{-- User Info --}}
        <div class="p-4 border-t border-[#1565C0]/10">
            <div class="bg-[#F5F6FA] p-3 rounded-lg flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#1565C0] text-white flex items-center justify-center font-bold text-xs flex-shrink-0">{{ $applicantInitials ?: 'CM' }}</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold text-[#1A1A2E] truncate">{{ $applicantName }}</p>
                    <p class="text-[10px] text-[#5A6478] truncate">Calon Mahasiswa</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 text-[#D32F2F] hover:bg-red-50 rounded-lg transition-colors text-xs font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="flex-grow flex flex-col min-w-0">
        {{-- Top Header --}}
        <header class="bg-white border-b border-[#1565C0]/15 h-16 px-4 md:px-8 flex items-center justify-between sticky top-0 z-40">
            
            {{-- Kiri: Hamburger Menu & Judul --}}
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-500 hover:text-[#1565C0] transition-colors flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="font-heading font-bold text-[#1A1A2E] text-base sm:text-lg truncate">@yield('title')</h1>
            </div>
            
            {{-- Kanan: Status & Notifikasi --}}
            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <span class="text-[10px] font-bold px-2 py-1 bg-yellow-50 text-[#F9A825] rounded-full uppercase">{{ $currentStatus }}</span>
                
                {{-- Lonceng Notifikasi --}}
                <button class="relative p-2 text-gray-400 hover:text-[#1565C0] transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>
            </div>
        </header>

        {{-- Dynamic Content Area --}}
        <div class="p-4 md:p-8">
            @yield('applicant_content')
        </div>
    </main>
</div>

@endsection
