<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BusinessPartnerController;
use App\Http\Controllers\ChartAccountController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoucherController;
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
    // cash voucher
    Route::get('home',[HomeController::class,'index'])->name('home');
    Route::post('home/post',[HomeController::class,'store'])->name('home.store');
    
    
    //voucher
    Route::get('voucher',[VoucherController::class,'index'])->name('voucher');
    Route::get('voucher/print/{cashVoucher}',[VoucherController::class,'printCV'])->name('voucher.print');
    Route::get('cheque/print/{cashVoucher}/{type}',[VoucherController::class,'printCheque'])->name('cheque.print');
    Route::get('voucher/download-summary',[VoucherController::class,'downloadSummary'])->name('voucher.download.summary');

    //branch
    Route::get('branch/{company}',[BranchController::class,'index'])->name('branch');
    Route::post('branch/store',[BranchController::class,'store'])->name('branch.store');
    // master of data (business partner)
    Route::get('bp-master',[BusinessPartnerController::class,'index'])->name('bp_master');
    Route::post('bp-master/post',[BusinessPartnerController::class,'store'])->name('bp_master.store');
    // chart of accounts
    Route::get('chartAccount',[ChartAccountController::class,'index'])->name('chartAccount');
    Route::post('chartAccount/post',[ChartAccountController::class,'store'])->name('chartAccount.store');
    //company
    Route::get('company',[CompanyController::class,'index'])->name('company');
    Route::post('company/post',[CompanyController::class,'store'])->name('company.store');
    //signout
    Route::post('signout', [AuthController::class, 'signout'])->name('signout');
});