<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobMatchController;
use App\Http\Controllers\CVBuilderController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CV Analysis
    Route::get('/cv', [CVController::class, 'index'])->name('cv.index');
    Route::post('/cv/upload', [CVController::class, 'upload'])->name('cv.upload');
    Route::get('/cv/{id}', [CVController::class, 'show'])->name('cv.show');
    Route::delete('/cv/{id}', [CVController::class, 'destroy'])->name('cv.destroy');

    // Interview Simulation
    Route::get('/interview', [InterviewController::class, 'index'])->name('interview.index');
    Route::get('/interview/start', [InterviewController::class, 'start'])->name('interview.start');
    Route::post('/interview/submit', [InterviewController::class, 'submit'])->name('interview.submit');

    // Job Matching
    Route::get('/match', [JobMatchController::class, 'index'])->name('match.index');
    Route::post('/match', [JobMatchController::class, 'match'])->name('match.analyze');
    Route::get('/match/{id}', [JobMatchController::class, 'show'])->name('match.show'); // ✅ AJOUTER CETTE LIGNE

    // CV Builder
    Route::get('/cvbuilder', [CVBuilderController::class, 'index'])->name('cvbuilder.index');
    Route::get('/cvbuilder/create', [CVBuilderController::class, 'create'])->name('cvbuilder.create');
    Route::post('/cvbuilder/generate', [CVBuilderController::class, 'generate'])->name('cvbuilder.generate');
    Route::get('/cvbuilder/{id}/edit', [CVBuilderController::class, 'edit'])->name('cvbuilder.edit');
    Route::put('/cvbuilder/{id}', [CVBuilderController::class, 'update'])->name('cvbuilder.update');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});