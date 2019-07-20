<?php

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

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusFormController;
use App\Http\Controllers\MainController;


// Authentication Routes...
Route::get('login',                                     [ LoginController::class, 'showLoginForm' ] )->name('login');
Route::post('login',                                    [ LoginController::class, 'login' ] );
Route::post('logout',                                   [ LoginController::class, 'logout' ] )->name('logout');


Route::middleware(['auth'])->group(function(){

    Route::get('/',                                     [ MainController::class, 'index'] );
    Route::get('/test/{bus}',                                     [ MainController::class, 'test'] );

    Route::prefix('buses')->group(function(){
        Route::get('/',                                 [ BusController::class, 'index'] );
        Route::get('dataTables',                        [ BusController::class, 'dataTables'] );
        Route::get('busForm',                           [ BusFormController::class, 'create'] );
        Route::get('busForm/{bus}',                     [ BusFormController::class, 'edit'] );
    });

});