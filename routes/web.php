<?php

use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\PesertaUjianController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:student')
        ->prefix('siswa/profile')
        ->name('siswa.profile.')
        ->controller(SiswaController::class)
        ->group(function () {
            Route::get('/', 'show')->name('show');
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
        });

    Route::middleware('role:admin')
        ->prefix('mata-pelajaran')
        ->name('mata-pelajaran.')
        ->controller(MataPelajaranController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{mataPelajaran}/edit', 'edit')->name('edit');
            Route::put('/{mataPelajaran}', 'update')->name('update');
            Route::delete('/{mataPelajaran}', 'destroy')->name('destroy');
        });

    Route::middleware('role:admin')
        ->prefix('ujian')
        ->name('ujian.')
        ->controller(UjianController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{ujian}/edit', 'edit')->name('edit');
            Route::put('/{ujian}', 'update')->name('update');
            Route::delete('/{ujian}', 'destroy')->name('destroy');
        });

    Route::redirect('/peserta-ujian/penialain', '/peserta-ujian');
    Route::redirect('/peserta-ujian/penilaian', '/peserta-ujian');

    Route::prefix('peserta-ujian')
        ->name('peserta-ujian.')
        ->controller(PesertaUjianController::class)
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{ujian}', 'show')->name('show');
            Route::post('/{ujian}/join', 'join')->name('join');
            Route::get('/{ujian}/penilaian', 'penilaianShow')->name('penilaian.show');
            Route::put('/{ujian}/{pesertaUjian}', 'penilaianUpdate')->name('penilaian.update');
        });
});
