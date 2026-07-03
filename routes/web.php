<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsultationController;
use App\Services\ForwardChainingService;

Route::get('/', function () {
    return view('pages.splash.index');
});

Route::redirect('/dashboard', '/home')->middleware(['auth', 'verified']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/home', 'pages.home.index')->name('home');

    Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
        Route::get('/', [ConsultationController::class, 'index'])->name('index');
        Route::post('/followup', [ConsultationController::class, 'followup'])->name('followup');
        Route::post('/answer', [ConsultationController::class, 'answer'])->name('answer');
        Route::get('/konfirmasi', [ConsultationController::class, 'confirmation'])->name('confirmation');
        Route::post('/konfirmasi', [ConsultationController::class, 'confirmation']);
        Route::get('/kembali', [ConsultationController::class, 'back'])->name('back');
        Route::post('/hasil', [ConsultationController::class, 'diagnose'])->name('result');
        Route::post('/simpan', [ConsultationController::class, 'store'])->name('store');
    });

    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::get('/', [ConsultationController::class, 'history'])->name('index');
        Route::get('/{id}', [ConsultationController::class, 'show'])->name('detail');
    });

    Route::view('/informasi', 'pages.informasi.index')->name('informasi');
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil');
});

Route::middleware('auth')->group(function () {
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-diagnosa', function (ForwardChainingService $forward) {
    return response()->json($forward->diagnose(['G01', 'G02', 'G06']));
});

require __DIR__ . '/auth.php';
