<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/clients', ClientController::class)->middleware(['auth', 'verified']);
Route::get('/client/recycle-bin', [ClientController::class, 'recycleBin'])->name('clients.recycleBin')->middleware(['auth', 'verified']);
Route::get('/client/restore/{id}', [ClientController::class, 'restore'])->name('clients.restore')->middleware(['auth', 'verified']);
Route::delete('/client/destroy-force/{id}', [ClientController::class, 'destroyForce'])->name('clients.destroyForce')->middleware(['auth', 'verified']);
Route::delete('/client/destroy-force-all', [ClientController::class, 'destroyForceAll'])->name('clients.destroyForceAll')->middleware(['auth', 'verified']);
Route::post('/client/restore-all', [ClientController::class, 'restoreAll'])->name('clients.restoreAll')->middleware(['auth', 'verified']);
Route::get('/client/export-to-excel', [ClientController::class, 'exportToExcel'])->name('clients.exportToExcel')->middleware(['auth', 'verified']);
Route::get('/client/export-to-pdf', [ClientController::class, 'exportToPDF'])->name('clients.exportToPDF')->middleware(['auth', 'verified']);


Route::resource('users', UserController::class)->middleware(['auth', 'verified']);
Route::get('/user/export-to-excel', [UserController::class, 'exportToExcel'])->name('users.exportToExcel')->middleware(['auth', 'verified']);
Route::get('/user/export-to-pdf', [UserController::class, 'exportToPDF'])->name('users.exportToPDF')->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
