<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;

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

Auth::routes(['verify' => true]);

Route::post('/account/update', [UserController::class, 'accountUpdate'])->name('account-update');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('status', [UserController::class, 'userOnlineStatus']);
