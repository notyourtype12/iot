<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/history/{id_history}/delete', [HistoryController::class, 'destroy'])->name('history.destroy');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


require __DIR__.'/auth.php';
