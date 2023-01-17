<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

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
Route::get('/login-page', [PagesController::class, 'loginPage'])->name('auth.login');

Route::group(['prefix' => 'auth', 'namespace' => 'v1\Auth'], function () {
    Route::post('/signup', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->middleware("auth:web");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
