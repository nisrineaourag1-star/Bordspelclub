<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePageController;
use Illuminate\Support\Facades\Route;

Route::get('/leden/{user}', [ProfilePageController::class, 'show'])->name('profile.show');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/club', [ProfileController::class, 'updateClubProfile'])->name('profile.club.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Nieuws: publiek zichtbaar
Route::get('/nieuws', [NewsController::class, 'index'])->name('news.index');
Route::get('/nieuws/{news}', [NewsController::class, 'show'])->name('news.show');

// Nieuws: enkel voor admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/nieuws-toevoegen', [NewsController::class, 'create'])->name('news.create');
    Route::post('/nieuws', [NewsController::class, 'store'])->name('news.store');
    Route::get('/nieuws/{news}/wijzigen', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/nieuws/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/nieuws/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
});

require __DIR__.'/auth.php';