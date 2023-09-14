<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddPasswordController;


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
    return view('landing');
})->name('landing');

Route::get('/add-password', function () {
    return view('add-password');
})->name('add-password');


Route::post('/test', [AddPasswordController::class, 'formValidation'])->name('test');
