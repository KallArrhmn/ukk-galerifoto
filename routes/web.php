<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikePhotoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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

Route::get('/', [PhotoController::class, 'home'])->name('home');

Route::controller(RegisterController::class)->name('register.')->group(function() {
    Route::get('/register', 'index')->name('index');
    Route::post('/register', 'processRegister')->name('process');
});

Route::controller(LoginController::class)->name('login.')->group(function() {
    Route::get('/login', 'index')->name('index');
    Route::post('/login', 'processLogin')->name('process');
});

Route::controller(PhotoController::class)->middleware('auth')->name('photo.')->group(function() {
    Route::get('/photo/{photo_id}', 'index')->name('index');
    Route::get('/post', 'postPhoto')->name('post');
    Route::post('/post', 'postPhotoProcess')->name('postProcess');
    Route::delete('/photo/{photo_id}/delete', 'deletePhoto')->name('delete');
});

Route::controller(LikePhotoController::class)->middleware('auth')->name('like_photo.')->group(function() {
    Route::post('/like', 'like')->name('like');
    Route::post('/unlike', 'unlike')->name('unlike');
});

Route::controller(CommentController::class)->middleware('auth')->name('comment.')->group(function() {
    Route::post('/comment', 'post')->name('post');
});

//hapus postingan
Route::post('/delete/{id}', [PhotoController::class, 'deletePost'])->name('delete.post');

Route::controller(ProfileController::class)->name('profile.')->group(function() {
    Route::get('/profile', 'index')->name('index');
    Route::get('/profile/{user_id}', 'people')->name('people');
});

Route::get('/logout', function() {
    if(auth()->check()) {
        auth()->logout();
        Alert::success('Berhasil Logout!');
    }
    return redirect()->route('login.index');
})->name('logout');
