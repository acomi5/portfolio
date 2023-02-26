<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::controller(UserController::class)->group(function () {
  Route::get('user/profile', 'profile')->name('profile')->middleware('auth');
  Route::get('user/profile/edit', 'edit')->name('profile.edit')->middleware('auth');
  Route::put('user/profile', 'update')->name('profile.update')->middleware('auth');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('post', PostController::class)->middleware('auth');

Route::get('/like/{post}', [LikeController::class, 'like'])->name('like');
Route::get('/index', [LikeController::class, 'index'])->name('post.show');
Route::get('/unlike/{post}', [LikeController::class, 'unlike'])->name('unlike');

