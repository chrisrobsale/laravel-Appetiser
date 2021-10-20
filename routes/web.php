<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])
    ->name('home.login');

Route::get('/welcome', [HomeController::class, 'welcome'])
    ->name('home.welcome');

Route::get('/registration', [HomeController::class, 'registration'])
    ->name('home.registration');

Route::post('/register',[HomeController::class, 'register'])
    ->name('home.register');
Route::get('/register',[HomeController::class, 'registration']);

Route::get('/verification', [HomeController::class, 'verification'])
    ->name('home.verification');

Route::post('/verify',[HomeController::class, 'verify'])
    ->name('home.verify');
Route::get('/verify',[HomeController::class, 'verification']);

Route::post('/userLogin',[HomeController::class, 'userLogin'])
    ->name('home.userLogin');
Route::get('/userLogin',[HomeController::class, 'index']);

Route::get('/userLogout',[HomeController::class, 'userLogout'])
    ->name('home.userLogout');

