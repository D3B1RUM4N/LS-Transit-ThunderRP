<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\TarifsController;
use App\Http\Controllers\FactureController;

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

Route::view('/', 'signin');
Route::view('/signin','signin')->name('view_signin');
Route::view('/signup', 'signup')->name('view_signup');

Route::post('/authenticate', [MyUserController::class, 'connect'])->name('user_authenticate');
Route::post('/adduser', [MyUserController::class, 'create'])->name('user_adduser');

// Patrons
Route::prefix('patrons')->group( function(){

});

// employees
Route::prefix('profile')->middleware('auth.myuser')->group( function(){
    Route::view('/account', 'account')->name('view_account');

    Route::get('/signout', [MyUserController::class, 'disconnect'])->name('user_signout');

    //factures
    Route::prefix('factures')->group( function(){
        Route::get('/show', [TarifsController::class, 'all'])->name('factures_new');
        Route::view('/add', 'addFacture')->name('view_facture_add');
        Route::view('/list', 'factures.list')->name('view_factures_list');
    });
});
