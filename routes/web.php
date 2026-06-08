<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Splash
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.splash.index');
});

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::redirect(
    '/dashboard',
    '/home'
)->middleware([
    'auth',
    'verified'
]);

/*
|--------------------------------------------------------------------------
| Protected Pages
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified'
])->group(function () {

    Route::view(
        '/home',
        'pages.home.index'
    );

    Route::view(
        '/konsultasi',
        'pages.konsultasi.index'
    );

    Route::view(
        '/riwayat',
        'pages.riwayat.index'
    );

    Route::view(
        '/informasi',
        'pages.informasi.index'
    );
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view(
        '/profil',
        'pages.profil.index'
    );

    Route::patch(
        '/profil',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profil',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

require __DIR__ . '/auth.php';
