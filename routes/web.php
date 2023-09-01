<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessPartnerController;
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


Route::middleware(['guest:web','preventBackHistory'])->name('auth.')->group(function () {
    Route::get('/', function () { return view('auth.signin'); })->name('signin');
    Route::post('/post', [AuthController::class, 'authenticate'])->name('post');
});


Route::middleware(['auth:web','auth.user','preventBackHistory'])->name('authenticated.')->prefix('auth/')->group(function(){

    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::get('bp-master',[BusinessPartnerController::class,'index'])->name('bp_master');
    //signout
    Route::post('signout', [AuthController::class, 'signout'])->name('signout');
});