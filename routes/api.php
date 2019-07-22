<?php

use App\Http\Controllers\Api\AppModuleController;
use App\Http\Controllers\Api\AppModulePermissionController;
use App\Http\Controllers\Api\AppModuleUserPermissionController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserBusDefinitionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmployeeRoleController;
use App\Http\Controllers\Api\EmploymentStatusController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserPermissionController;
use App\Http\Controllers\MainController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api', 'role:admin'])->group(function(){

    Route::resource('users',                                        UserController::class );
    Route::resource('buses',                                        BusController::class );
    Route::resource('app_modules',                                  AppModuleController::class );
    Route::resource('permissions',                                  PermissionController::class );
    Route::resource('user_permissions',                             UserPermissionController::class );

});

Route::post('login', [ LoginController::class, 'authenticate'] ); // retrieve api token