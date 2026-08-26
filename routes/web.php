<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
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

// FAQ: publiek zichtbaar
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

// FAQ: enkel voor admins
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/faq-beheer', [FaqController::class, 'manage'])->name('faq.manage');
    Route::post('/faq/categorie', [FaqController::class, 'storeCategory'])->name('faq.category.store');
    Route::delete('/faq/categorie/{faqCategory}', [FaqController::class, 'destroyCategory'])->name('faq.category.destroy');
    Route::post('/faq/vraag', [FaqController::class, 'storeItem'])->name('faq.item.store');
    Route::delete('/faq/vraag/{faqItem}', [FaqController::class, 'destroyItem'])->name('faq.item.destroy');
});

// Contact: publiek zichtbaar
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

require __DIR__.'/auth.php';