<?php

use App\Http\Controllers\RegisterController;

use Illuminate\Support\Facades\Route;

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
    return view('layouts.app');
})->name('home');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'processRegister'])->name('register.process');