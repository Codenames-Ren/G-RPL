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

Route::get('/dashboard-asesor', function () {
    return view('assessor.dashboard');
})->name('dashboard.assessor');
Route::get('/asesor/antrean', function () {
    return view('assessor.queue');
})->name('assessor.queue');

Route::get('/asesor/riwayat', function () {
    return view('assessor.history');
})->name('assessor.history');

// 4. Route Auth (Login/Register bawaan Laravel)
require __DIR__.'/api.php';