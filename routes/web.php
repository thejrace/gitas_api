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
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormController;


// Authentication Routes...
Route::get('login',                                             [ LoginController::class, 'showLoginForm' ] )->name('login');
Route::post('login',                                            [ LoginController::class, 'login' ] );
Route::post('logout',                                           [ LoginController::class, 'logout' ] )->name('logout');

// @todo = permissions

Route::middleware(['auth'])->group(function(){

    Route::get('/',                                             [ MainController::class, 'index'] );
    Route::get('/test/{bus}',                                   [ MainController::class, 'test'] );

    Route::prefix('buses')->group(function(){
        Route::get('/',                                         [ BusController::class, 'index'] )->name('buses.index');
        Route::get('dataTables',                                [ BusController::class, 'dataTables'] );
        Route::get('form',                                      [ BusFormController::class, 'create'] )->name('buses.form');
        Route::get('form/{bus}',                                [ BusFormController::class, 'edit'] );
    });

    Route::prefix('app_modules')->group(function(){
        Route::get('/',                                         [ BusController::class, 'index'] )->name('app_modules.index');
        Route::get('dataTables',                                [ BusController::class, 'dataTables'] );
        Route::get('form',                                      [ BusFormController::class, 'create'] )->name('app_modules.form');
        Route::get('form/{app_module}',                                [ BusFormController::class, 'edit'] );
    });

    Route::prefix('users')->group(function(){
        Route::get('/',                                         [ UserController::class, 'index'] )->name('users.index');
        Route::get('dataTables',                                [ UserController::class, 'dataTables'] );
        Route::get('form',                                      [ UserFormController::class, 'create'] )->name('users.form');
        Route::get('form/{user}',                               [ UserFormController::class, 'edit'] );
    });

});