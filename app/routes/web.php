<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/change-password/{id}', [PasswordController::class, 'showOne'])->name("password.showOne");
Route::post('/change-password/{id}', [PasswordController::class, 'update'])->name("password.updated");

Route::get('/add-password', function () { return view('add-password'); })->name("password.add");
Route::get('/passwords', [PasswordController::class, 'show'])->name("password.show");
Route::post('/add-password', [PasswordController::class, 'store'])->name("password.stored");

Route::get('/add-team', function () { return view('add-team'); })->name("team.add");
Route::get('/teams', [TeamController::class, 'show'])->name("team.show");
Route::post('/add-team', [TeamController::class, 'store'])->name("team.store");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
