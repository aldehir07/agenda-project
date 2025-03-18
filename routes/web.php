<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\AgendaController;


Route::get("/", [MainController::class, "index"])->name("home");

//Rutas para la Reserva
Route::resource('reservas', ReservaController::class)->middleware('auth');

// Rutas para la Agenda
Route::resource('agenda', AgendaController::class)->middleware('auth');


Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
