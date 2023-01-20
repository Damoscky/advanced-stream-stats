<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\v1\Auth\LoginController;
use App\Http\Controllers\v1\Auth\RegisterController;

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

Route::get('/', [PagesController::class, 'index'])->name('auth.index');
Route::get('/login-page', [PagesController::class, 'loginPage'])->name('login-page');

Route::group(['prefix' => 'auth', 'namespace' => 'v1\Auth'], function () {
    Route::post('/signup', [RegisterController::class, 'register'])->name('auth.register');
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
