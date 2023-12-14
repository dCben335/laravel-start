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

Route::get('/passwords/{id}/update', [PasswordController::class, 'showOne'])->name("password.update");
Route::post('/passwords/{id}/update/password', [PasswordController::class, 'update'])->name("password.updatePwd");
Route::post('/passwords/{id}/update/team', [PasswordController::class, 'udpdateTeam'])->name("password.updateTeam");

Route::get('/passwords', [PasswordController::class, 'show'])->name("password.show");
Route::get('/passwords/create', function () { return view('passwords/single/create'); })->name("password.add");
Route::post('/password/create', [PasswordController::class, 'store'])->name("password.stored");

Route::get('/teams', [TeamController::class, 'show'])->name("team.show");
Route::get('/teams/create', function () { return view('/teams/single/create'); })->name("team.add");
Route::post('/teams/create', [TeamController::class, 'store'])->name("team.store");
Route::get('/teams/{id}', [TeamController::class, 'showOne'])->name("team.showOne");
Route::get('/teams/{id}/invite', [TeamController::class, 'invitation'])->name("team.invitation");
Route::post('/teams/{id}/invite', [TeamController::class, 'invite'])->name("team.invite");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
