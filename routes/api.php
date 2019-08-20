<?php

use App\Http\Controllers\Api\AppModuleController;
use App\Http\Controllers\Api\AppModuleUserController;
use App\Http\Controllers\Api\AppModuleUserPermissionController;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionTypeController;
use App\Http\Controllers\Api\UserController;
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
    //Route::resource('app_module_users',                             AppModuleUserController::class );

    Route::prefix('app_module_users')->group(function(){
        Route::get('{app_module}',                                      [AppModuleUserController::class, 'index']);
        Route::get('{app_module}/{app_module_user}',                    [AppModuleUserController::class, 'show']);
        Route::post('/',                                                [AppModuleUserController::class, 'store']);
        Route::put('{app_module_user}',                                 [AppModuleUserController::class, 'update']);
        Route::delete('{app_module_user}',                              [AppModuleUserController::class, 'destroy']);
    });

    Route::resource('permissions',                                  PermissionController::class );
    Route::resource('permission_types',                             PermissionTypeController::class );

    Route::prefix('user_permissions')->group(function(){
        Route::delete('{user}/{permission}',                                    [ UserPermissionController::class, "revokePermission" ] );
        Route::post('{user}/{permission}',                                      [ UserPermissionController::class, "givePermission" ] );
        Route::get('{user}',                                                    [ UserPermissionController::class, "getPermissions" ] );
    });

    Route::prefix('app_module_user_permissions')->group(function(){
        Route::delete('{app_module_user}/{permission}',                                    [ AppModuleUserPermissionController::class, "revokePermission" ] );
        Route::post('{app_module_user}/{permission}',                                      [ AppModuleUserPermissionController::class, "givePermission" ] );
        Route::get('{app_module_user}/{permission}',                                       [ AppModuleUserPermissionController::class, "hasPermission" ] );
        Route::get('{app_module_user}',                                                    [ AppModuleUserPermissionController::class, "getPermissions" ] );
    });

});

Route::prefix('permission_check')->group(function(){
    Route::get('{app_module_user}/{permission}',                                       [ AppModuleUserPermissionController::class, "hasPermission" ] );
});

Route::middleware(['auth:app_module'])->group(function(){

    Route::prefix('app_module_pipeline')->group(function(){

        Route::post('app_module_user_login', [AppModuleUserController::class, 'login']);
        Route::post('app_module_user_validate', [AppModuleUserController::class, 'validateToken']);

        Route::get('app_module_users/{app_module}', [AppModuleUserController::class, 'index'] );
        Route::get('app_module_user_data/{app_module_user}', [AppModuleUserController::class, 'fetchData'] );

        Route::get('permission_check/{app_module_user}/{permission}',                                       [ AppModuleUserPermissionController::class, "hasPermission" ] );

    });

});

Route::post('login',                                                            [ LoginController::class, 'authenticate'] ); // retrieve api token
