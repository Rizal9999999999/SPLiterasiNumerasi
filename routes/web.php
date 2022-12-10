<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KompetensiController;
use App\Http\Controllers\RelasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'level'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'show'])->name('home');
        Route::get('/', [HomeController::class, 'show'])->name('home');

        Route::get('/event/view', [EventController::class, 'view'])->name('event.view');
        Route::resource('/event', EventController::class)->parameters([
            'event' => 'event'
        ]);
        Route::get('/guru/cetak', [GuruController::class, 'cetak'])->name('guru.cetak');
        Route::resource('/guru', GuruController::class)->parameters([
            'guru' => 'guru'
        ]);
        Route::get('/kelas/cetak', [KelasController::class, 'cetak'])->name('kelas.cetak');
        Route::resource('/kelas', KelasController::class)->parameters([
            'kelas' => 'kelas'
        ]);
        Route::get('/siswa/cetak', [SiswaController::class, 'cetak'])->name('siswa.cetak');
        Route::resource('/siswa', SiswaController::class)->parameters([
            'siswa' => 'siswa'
        ]);
        Route::get('/jenis/cetak', [JenisController::class, 'cetak'])->name('jenis.cetak');
        Route::resource('/jenis', JenisController::class)->parameters([
            'jenis' => 'jenis'
        ]);
        Route::get('/kompetensi/cetak', [KompetensiController::class, 'cetak'])->name('kompetensi.cetak');
        Route::resource('/kompetensi', KompetensiController::class);
        Route::get('/indikator/cetak', [IndikatorController::class, 'cetak'])->name('indikator.cetak');
        Route::resource('/indikator', IndikatorController::class);
        Route::get('/solusi/cetak', [SolusiController::class, 'cetak'])->name('solusi.cetak');
        Route::resource('/solusi', SolusiController::class);
        Route::get('/relasi/cetak', [RelasiController::class, 'cetak'])->name('relasi.cetak');
        Route::get('/relasi/aturan', [RelasiController::class, 'aturan'])->name('relasi.aturan');
        Route::resource('/relasi', RelasiController::class);

        Route::get('/hitung/pra', [HitungController::class, 'pra'])->name('hitung.pra');
        Route::get('/hitung', [HitungController::class, 'index'])->name('hitung.index');
        Route::post('/hitung/action', [HitungController::class, 'action'])->name('hitung.action');
        Route::get('/hitung/indikator', [HitungController::class, 'indikator'])->name('hitung.indikator');
        Route::post('/hitung/indikator_action', [HitungController::class, 'indikator_action'])->name('hitung.indikator_action');

        Route::get('/hitung/cetak', [HitungController::class, 'cetak'])->name('hitung.cetak');
        Route::get('/hitung/ulang', [HitungController::class, 'ulang'])->name('hitung.ulang');
        Route::get('/histori/cetak', [HistoriController::class, 'cetak'])->name('histori.cetak');
        Route::get('/histori/detail', [HistoriController::class, 'detail'])->name('histori.detail');
        Route::resource('/histori', HistoriController::class);

        Route::get('/user/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/user/profil', [UserController::class, 'profilUpdate'])->name('user.profil.update');
        Route::get('/user/password', [UserController::class, 'password'])->name('user.password');
        Route::post('/user/password', [UserController::class, 'passwordUpdate'])->name('user.password.update');
        Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::resource('user', UserController::class);
    }
);
Route::get('/login', [UserController::class, 'loginForm'])->name('login');
Route::post('/login', [UserController::class, 'loginAction'])->name('login.action');
Route::get('/daftar', [UserController::class, 'daftarForm'])->name('daftar');
Route::post('/daftar', [UserController::class, 'daftarAction'])->name('daftar.action');
