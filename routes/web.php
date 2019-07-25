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

use App\Http\Controllers\AppModuleController;
use App\Http\Controllers\AppModuleFormController;
use App\Http\Controllers\AppModulePermissionController;
use App\Http\Controllers\AppModuleUserController;
use App\Http\Controllers\AppModuleUserFormController;
use App\Http\Controllers\AppModuleUserPermissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusFormController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionFormController;
use App\Http\Controllers\PermissionTypeController;
use App\Http\Controllers\PermissionTypeFormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormController;
use App\Http\Controllers\UserPermissionController;


// Authentication Routes...
Route::get('login',                                                         [ LoginController::class, 'showLoginForm' ] )->name('login');
Route::post('login',                                                        [ LoginController::class, 'login' ] );
Route::post('logout',                                                       [ LoginController::class, 'logout' ] )->name('logout');

// @todo = permissions

Route::middleware(['auth', 'role:admin'])->group(function(){

    Route::get('/',                                                         [ MainController::class, 'index'] );
    Route::get('/test',                                                     [ MainController::class, 'test'] );

    Route::prefix('user_permissions')->group(function(){
        Route::get('dataTables/{user}',                                     [ UserPermissionController::class, 'dataTables'] );
        Route::get('{user}',                                                [ UserPermissionController::class, 'index'] )->name('user_permissions.index');
    });

    Route::prefix('permissions')->group(function(){

        Route::get('store/{permission_type}',                               [ PermissionFormController::class, 'create'] )->name('permissions.store');
        Route::get('update/{permission}',                                   [ PermissionFormController::class, 'edit'] );
        Route::get('{permission_type}',                                     [ PermissionController::class, 'index'] );
        Route::get('dataTables/{permission_type}',                                     [ PermissionController::class, 'dataTables'] );
    });

    Route::prefix('permission_types')->group(function(){

        Route::get('form',                                                  [ PermissionTypeFormController::class, 'create'] )->name('permission_types.form');
        Route::get('form/{permission_type}',                                [ PermissionTypeFormController::class, 'edit'] );
        Route::get('dataTables',                                            [ PermissionTypeController::class, 'dataTables'] );
        Route::get('/',                                                     [ PermissionTypeController::class, 'index'] )->name('permission_types.index');
    });


    Route::prefix('buses')->group(function(){
        Route::get('/',                                                     [ BusController::class, 'index'] )->name('buses.index');
        Route::get('dataTables',                                            [ BusController::class, 'dataTables'] );
        Route::get('form',                                                  [ BusFormController::class, 'create'] )->name('buses.form');
        Route::get('form/{bus}',                                            [ BusFormController::class, 'edit'] );
    });

    Route::prefix('app_modules')->group(function(){
        Route::get('/',                                                     [ AppModuleController::class, 'index'] )->name('app_modules.index');
        Route::get('dataTables',                                            [ AppModuleController::class, 'dataTables'] );
        Route::get('form',                                                  [ AppModuleFormController::class, 'create'] )->name('app_modules.form');
        Route::get('form/{app_module}',                                     [ AppModuleFormController::class, 'edit'] );
    });

    Route::prefix('app_module_users')->group(function(){


        Route::get('store/{app_module}',                                    [ AppModuleUserFormController::class, 'create'] )->name('app_module_users.form');
        Route::get('update/{app_module_user}',                              [ AppModuleUserFormController::class, 'edit'] );
        Route::get('dataTables/{app_module}',                               [ AppModuleUserController::class, 'dataTables'] );
        Route::get('{app_module}',                                          [ AppModuleUserController::class, 'index'] )->name('app_module_users.index');
    });

    Route::prefix('app_module_user_permissions')->group(function(){
        Route::get('dataTables/{app_module_user}',                          [ AppModuleUserPermissionController::class, 'dataTables'] );
        Route::get('/{app_module_user}',                                    [ AppModuleUserPermissionController::class, 'index'] )->name('app_module_user_permissions.index');
    });

    Route::prefix('app_module_permissions')->group(function(){

        Route::get('dataTables/{app_module}',                               [ AppModulePermissionController::class, 'dataTables'] );
        Route::get('{app_module}',                                          [ AppModulePermissionController::class, 'index'] )->name('app_module_permissions.index');

    });

    Route::prefix('users')->group(function(){
        Route::get('/',                                                     [ UserController::class, 'index'] )->name('users.index');
        Route::get('dataTables',                                            [ UserController::class, 'dataTables'] );
        Route::get('form',                                                  [ UserFormController::class, 'create'] )->name('users.form');
        Route::get('form/{user}',                                           [ UserFormController::class, 'edit'] );
    });

});