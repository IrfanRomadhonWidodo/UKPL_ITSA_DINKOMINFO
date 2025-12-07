<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pages\KontakController;
use App\Http\Controllers\Pages\ProfilController;
use App\Http\Controllers\Pages\DownloadController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\FeedbackAdminController;
use App\Http\Controllers\Admin\HasilAdminController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Pages\FormulirController;
use App\Http\Controllers\Admin\FormulirAdminController;
use App\Http\Controllers\Pages\RiwayatController;
use App\Http\Controllers\Pages\FAQController;
use App\Http\Controllers\Pages\PanduanController;
use App\Http\Controllers\Pages\LayananController;

Route::get('/', fn () => view('auth.login'));

// -------------------------
// Guest Only (No Auth)
// -------------------------
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

// -------------------------
// Public Pages (Optional: protect if needed)
// -------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/alur-layanan', [LayananController::class, 'index'])->name('alur-layanan');
    Route::get('/profil-itsa', [ProfilController::class, 'index'])->name('profil-itsa');
    Route::get('/panduan', [PanduanController::class, 'index'])->name('panduan');
    Route::get('/faq', [FAQController::class, 'index'])->name('faq');
    Route::get('/download', [DownloadController::class, 'index'])->name('download');
    Route::get('/download/file', [DownloadController::class, 'download'])->name('download.file');
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::post('/kontak/feedback', [KontakController::class, 'storeFeedback'])->name('kontak.feedback');
});

// -------------------------
// Authenticated Users Only
// -------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifikasi
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/', [NotifikasiController::class, 'index'])->name('index');
        Route::get('/{id}', [NotifikasiController::class, 'show'])->name('show');
        Route::post('/{id}/mark-read', [NotifikasiController::class, 'markAsRead'])->name('mark-read');
        Route::post('/mark-all-read', [NotifikasiController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::delete('/{id}', [NotifikasiController::class, 'destroy'])->name('destroy');
        Route::delete('/', [NotifikasiController::class, 'destroyAll'])->name('destroyAll');
        Route::post('/delete-multiple', [NotifikasiController::class, 'deleteMultiple'])->name('deleteMultiple');
    });

    // Formulir
    Route::prefix('formulir')->name('formulir.')->group(function () {
        Route::get('/', [FormulirController::class, 'index'])->name('index');
        Route::post('/store', [FormulirController::class, 'store'])->name('store');
        Route::post('/auto-save', [FormulirController::class, 'autoSave'])->name('auto-save');
        Route::get('/data', [FormulirController::class, 'getData'])->name('data');
        Route::post('/preview', [FormulirController::class, 'preview'])->name('preview');
        Route::post('/submit', [FormulirController::class, 'submit'])->name('submit');
        Route::get('/success', fn () => view('pages.formulir-success'))->name('success');
    });

    // Riwayat
    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
        Route::get('/{id}', [RiwayatController::class, 'show'])->name('show');
        Route::post('/{id}', [RiwayatController::class, 'update'])->name('update');
        Route::get('/{id}/download', [RiwayatController::class, 'downloadPdf'])->name('download');
    });
});

// -------------------------
// Admin Routes
// -------------------------
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserAdminController::class);
    Route::resource('feedbacks', FeedbackAdminController::class);
    Route::resource('formulir', FormulirAdminController::class);
    Route::resource('hasil', HasilAdminController::class);
    Route::post('/hasil', [HasilAdminController::class, 'store'])->name('hasil.store');
    Route::put('/formulir/{formulir}/upload-file', [FormulirAdminController::class, 'uploadFile'])->name('formulir.uploadFile');
});

require __DIR__ . '/auth.php';
