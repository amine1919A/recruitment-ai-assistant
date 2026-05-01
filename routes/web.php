<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CVController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});


Route::middleware('auth')->group(function () {
    Route::get('/cv', [CVController::class, 'index']);
    Route::post('/cv/upload', [CVController::class, 'upload']);
});

Route::middleware('auth')->group(function () {

    Route::get('/interview', [InterviewController::class, 'index']);
    Route::get('/interview/start', [InterviewController::class, 'start']);
    Route::post('/interview/submit', [InterviewController::class, 'submit']);

});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
