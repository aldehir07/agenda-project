<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegistroReservaController;
use App\Http\Controllers\ReservaCalController;

Route::get("/", [MainController::class, "index"])->name("home");
Route::get('/calendario', [ReservaCalController::class, 'index'])->name('calendario');
Route::get('/reservaCal/create', [ReservaCalController::class, 'create'])->name('reservaCal.create');
Route::post('/reservaCal/store', [ReservaCalController::class, 'store'])->name('reservaCal.store');

Route::resource('/registro', RegistroReservaController::class);

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
