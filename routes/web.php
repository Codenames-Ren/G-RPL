<?php

use Illuminate\Support\Facades\Route;

// 1. Halaman Beranda (Landing Page)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// 2. Halaman Dashboard Mahasiswa (Bypass Login untuk FE)
Route::get('/dashboard', function () {
    // Pastikan ini mengarah ke file dashboard yang baru kita buat.
    // Jika kamu menyimpannya di resources/views/applicant/dashboard.blade.php
    return view('applicant.dashboard'); 
})->name('dashboard');

// ===== TAMBAHAN DARI FE: Routes untuk Applicant (Proses Pengajuan RPL) =====
Route::get('/applicant/profile', function () {
    return view('applicant.profile');
})->name('applicant.profile');

Route::get('/applicant/program', function () {
    return view('applicant.program');
})->name('applicant.program');

Route::get('/applicant/documents', function () {
    return view('applicant.documents');
})->name('applicant.documents');

Route::get('/applicant/outcomes', function () {
    return view('applicant.outcomes');
})->name('applicant.outcomes');

// 3. Halaman-halaman Informasi Publik
Route::get('/tentang-rpl', function () {
    return view('pages.about');
})->name('about');

Route::get('/persyaratan', function () {
    return view('pages.requirements');
})->name('requirements');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/pengumuman', function () {
    return view('pages.announcements');
})->name('announcements');

// 4. Routes untuk Role Asesor
Route::get('/dashboard-asesor', function () {
    return view('assessor.dashboard');
})->name('dashboard.assessor');

Route::get('/asesor/antrean', function () {
    return view('assessor.queue');
})->name('assessor.queue');

Route::get('/asesor/riwayat', function () {
    return view('assessor.history');
})->name('assessor.history');

// ===== TAMBAHAN DARI FE: Routes untuk Role Manajer/Pengelola =====
Route::get('/dashboard-manager', function () {
    return view('manager.dashboard');
})->name('dashboard.manager');

Route::get('/manager/pengajuan', function () {
    return view('manager.applications');
})->name('manager.applications');

Route::get('/manager/assign', function () {
    return view('manager.assignment');
})->name('manager.assignment');

Route::get('/manager/asesor', function () {
    return view('manager.asesors');
})->name('manager.asesors');

Route::get('/manager/laporan', function () {
    return view('manager.reports');
})->name('manager.reports');

// 5. Route Auth (Login/Register bawaan Laravel) & API
require __DIR__.'/auth.php';
require __DIR__.'/api.php';