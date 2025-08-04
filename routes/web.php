<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KuisController as AdminKuisController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\VideoTutorialController as AdminVideoTutorialController;
use App\Http\Controllers\Admin\Objek3DController;

// Guru Controllers
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Guru\KuisController as GuruKuisController;
use App\Http\Controllers\Guru\HasilKuisController as GuruHasilKuisController;
use App\Http\Controllers\Guru\GaleriController as GuruGaleriController;
use App\Http\Controllers\Guru\VideoTutorialController as GuruVideoTutorialController;
use App\Http\Controllers\Guru\Objek3DController as GuruObjek3DController;
use App\Http\Controllers\Guru\KaryaSiswaController as GuruKaryaSiswaController;

// Siswa Controllers
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Siswa\GaleriController as SiswaGaleriController;
use App\Http\Controllers\Siswa\MateriController as SiswaMateriController;
use App\Http\Controllers\Siswa\KuisController as SiswaKuisController;
use App\Http\Controllers\Siswa\HasilKuisController as SiswaHasilKuisController;
use App\Http\Controllers\Siswa\Objek3DController as SiswaObjek3DController;
use App\Http\Controllers\Siswa\GaleriController;

// Umum
use App\Http\Controllers\KuisController;
use App\Http\Controllers\HasilKuisController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\Kamera3DController;
use App\Http\Controllers\HotspotController;

Route::get('/', fn () => view('welcome'));

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        $user = auth()->user();
        return match (true) {
            $user->hasRole('Admin') => redirect()->route('admin.dashboard'),
            $user->hasRole('Guru') => redirect()->route('guru.dashboard'),
            $user->hasRole('Siswa') => redirect()->route('siswa.dashboard'),
            default => abort(403, 'Unauthorized'),
        };
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('kamera', Kamera3DController::class);
    Route::resource('hotspot', HotspotController::class);
});

Route::resource('kuis', KuisController::class);

// ======================== ADMIN ===========================
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('materi', MateriController::class);
    Route::resource('users', UserController::class);
    Route::resource('kuis', AdminKuisController::class);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('video-tutorial', AdminVideoTutorialController::class);
    Route::resource('objek3d', Objek3DController::class);
    Route::get('materi/{id}/preview', [MateriController::class, 'preview'])->name('materi.preview');
    Route::get('hasil-kuis', [HasilKuisController::class, 'index'])->name('hasilkuis.index');
    Route::get('hasil-kuis/export', [HasilKuisController::class, 'export'])->name('hasilkuis.export');
    Route::get('komentar', [KomentarController::class, 'index'])->name('komentar.index');
    Route::post('komentar/{id}/balas', [KomentarController::class, 'balas'])->name('komentar.balas');
});

// ======================== GURU ============================
Route::middleware(['auth', 'role:Guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('dashboard', [GuruController::class, 'index'])->name('dashboard');
    Route::resource('materi', GuruMateriController::class);
    Route::resource('kuis', GuruKuisController::class);
    Route::resource('hasilkuis', GuruHasilKuisController::class);
    Route::resource('galeri', GuruGaleriController::class);
    Route::resource('video-tutorial', GuruVideoTutorialController::class);
    Route::resource('objek3d', GuruObjek3DController::class);
    Route::resource('karyasiswa', GuruKaryaSiswaController::class);
    Route::get('kamera3d', [Kamera3DController::class, 'index'])->name('kamera3d.index');
    Route::get('kuis/{id}/detail', [GuruKuisController::class, 'show'])->name('kuis.show');
    Route::get('/materi/{materi}/diskusi', [App\Http\Controllers\Guru\MateriDiskusiController::class, 'show'])->name('materi.diskusi');
    Route::post('materi/{id}/komentar', [MateriController::class, 'komentar'])->name('guru.materi.komentar');
    Route::get('materi/{id}/diskusi', [MateriController::class, 'diskusi'])->name('guru.materi.diskusi');
});

Route::delete('guru/kuis/delete-by-judul/{judul}', [KuisController::class, 'destroyByJudul'])->where('judul', '.*')->name('guru.kuis.destroyJudul');

// ======================== SISWA ===========================
Route::middleware(['auth', 'role:Siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('dashboard', [SiswaController::class, 'index'])->name('dashboard');
    Route::resource('galeri', SiswaGaleriController::class);
    Route::get('materi', [SiswaMateriController::class, 'index'])->name('materi.index');
    Route::get('materi/{id}', [SiswaMateriController::class, 'show'])->name('materi.show');

    // ✅ Kuis untuk siswa
    Route::get('kuis', [SiswaKuisController::class, 'index'])->name('kuis.index');
    Route::get('kuis/{judul}/kerjakan', [SiswaKuisController::class, 'kerjakan'])->name('kuis.kerjakan');
    Route::post('kuis/{judul}/submit', [SiswaKuisController::class, 'submitKerjakan'])->name('kuis.submit');
    Route::post('kuis/submit-langsung', [SiswaKuisController::class, 'submit'])->name('kuis.submitLangsung'); // opsional jika dipakai form submit langsung

    Route::get('objek3d', [SiswaObjek3DController::class, 'index'])->name('objek3d.index');
    Route::get('objek3d/{id}', [SiswaObjek3DController::class, 'show'])->name('objek3d.show');
    Route::get('hasil-kuis', [SiswaHasilKuisController::class, 'index'])->name('hasilkuis.index');
    Route::get('materi/{materi}/diskusi', [App\Http\Controllers\Siswa\MateriDiskusiController::class, 'show'])->name('materi.diskusi');
});


Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/komentar/store', [KomentarController::class, 'store'])->name('komentar.store');
    Route::post('/komentar/balas', [KomentarController::class, 'balas'])->name('komentar.balas');
    Route::post('/notifikasi/baca-semua', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifikasi.baca');
});

Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
Route::post('/diskusi', [DiskusiController::class, 'store'])->name('diskusi.store');

Route::get('/materi/{id}/diskusi', [App\Http\Controllers\MateriController::class, 'diskusi'])->name('materi.diskusi');

Route::get('/file/materi/{filename}', function ($filename) {
    $path = storage_path("app/public/materi_files/{$filename}");
    abort_unless(file_exists($path), 404);
    return response()->file($path);
})->name('materi.preview');

Route::get('/test-role', fn () => 'Role Middleware aktif!')->middleware(['auth', 'role:Siswa']);
Route::get('/kamera3d', fn () => view('kamera3d'));
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');



