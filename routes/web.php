<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Ubah bagian ini
Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // Tambahkan ini

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Halaman Beranda
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Halaman-halaman baru
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

require __DIR__.'/auth.php';
