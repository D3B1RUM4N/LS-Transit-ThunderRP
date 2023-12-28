<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyUserController;
use App\Http\Controllers\TarifsController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\GradesController;

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

Route::get('/', [MyUserController::class, 'test'])->name('test');
Route::view('/signin','signin')->name('view_signin');
//Route::view('/signup', 'signup')->name('view_signup');
Route::post('/authenticate', [MyUserController::class, 'connect'])->name('user_authenticate');

// Patrons
Route::prefix('patrons')->group( function(){

});

// employees
Route::prefix('profile')->middleware('auth.myuser')->group( function(){
    Route::view('/account', 'account')->name('view_account');

    Route::get('/signout', [MyUserController::class, 'disconnect'])->name('user_signout');

    //factures
    Route::prefix('factures')->group( function(){
        Route::get('/show', [TarifsController::class, 'allSelect'])->name('factures_new');
        Route::view('/add', 'addFacture')->name('view_facture_add');
        Route::post('/add', [FacturesController::class, 'create'])->name('facture_add');
        Route::get('/showlist', [FacturesController::class, 'empFacture'])->name('factures_list');
        Route::view('/list', 'showFactures')->name('view_factures_list');
    });
});

// patrons 
Route::prefix('gestion')->middleware('auth.patron')->group( function(){
    Route::get('/showEmployees', [MyUserController::class, 'employees'])->name('employees_list');
    Route::view('/employees', 'gestionEmployee')->name('view_employees');
    Route::post('/adduser', [MyUserController::class, 'create'])->name('user_adduser');
    Route::post('/changeuser', [MyUserController::class, 'changeLogin'])->name('user_changeuser');
    Route::post('/deleteuser', [MyUserController::class, 'delete'])->name('user_deleteuser');

    Route::get('/showFactures', [FacturesController::class, 'all'])->name('gestion_factures_list');
    Route::view('/factures', 'gestionFacture')->name('view_factures');

    Route::get('/showTarifs', [TarifsController::class, 'all'])->name('tarifs_list');
    Route::view('/tarifs', 'gestionTarifs')->name('view_tarifs');
    Route::post('/addtarif', [TarifsController::class, 'create'])->name('tarif_add');
    Route::post('/changetarif', [TarifsController::class, 'edit'])->name('tarif_change');
    Route::post('/deletetarif', [TarifsController::class, 'delete'])->name('tarif_delete');

    Route::get('/showGrades', [GradesController::class, 'all'])->name('grades_list');
    Route::view('/grades', 'gestionGrades')->name('view_grades');
    Route::post('/addgrade', [GradesController::class, 'create'])->name('grade_add');
    Route::post('/changegrade', [GradesController::class, 'edit'])->name('grade_change');
    Route::post('/deletegrade', [GradesController::class, 'delete'])->name('grade_delete');

    Route::post('/employe', [MyUserController::class, 'emp'])->name('employees_show');
    Route::view('/showEmploye', 'employerShow')->name('user_showuser');
});