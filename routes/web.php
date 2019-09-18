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
use App\Http\Controllers\AppModulePermissionFormController;
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
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteIntersectionController;
use App\Http\Controllers\RouteScannerController;
use App\Http\Controllers\RouteScannerFormController;
use App\Http\Controllers\RouteScannerPreviewController;
use App\Http\Controllers\RouteStopController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormController;
use App\Http\Controllers\UserPermissionController;

// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// @todo = permissions

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/test/{user}', [MainController::class, 'test']);

    Route::prefix('user_permissions')->group(function() {
        Route::get('dataTables/not_defined/{user}', [UserPermissionController::class, 'dataTablesNotDefined']);
        Route::get('dataTables/defined/{user}', [UserPermissionController::class, 'dataTablesDefined']);
        Route::get('{user}', [UserPermissionController::class, 'index'])->name('user_permissions.index');
    });

    Route::prefix('permissions')->group(function() {
        Route::get('store/{permission_type}', [PermissionFormController::class, 'create'])->name('permissions.store');
        Route::get('update/{permission_type}/{permission}', [PermissionFormController::class, 'edit']);
        Route::get('{permission_type}', [PermissionController::class, 'index']);
    });

    Route::prefix('permission_types')->group(function() {
        Route::get('form', [PermissionTypeFormController::class, 'create'])->name('permission_types.form');
        Route::get('form/{permission_type}', [PermissionTypeFormController::class, 'edit']);
        Route::get('dataTables', [PermissionTypeController::class, 'dataTables']);
        Route::get('/', [PermissionTypeController::class, 'index'])->name('permission_types.index');
    });


    Route::prefix('buses')->group(function() {
        Route::get('/', [BusController::class, 'index'])->name('buses.index');
        Route::get('dataTables', [BusController::class, 'dataTables']);
        Route::get('form', [BusFormController::class, 'create'])->name('buses.form');
        Route::get('form/{bus}', [BusFormController::class, 'edit']);
    });


    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('dataTables', [UserController::class, 'dataTables']);
        Route::get('form', [UserFormController::class, 'create'])->name('users.form');
        Route::get('form/{user}', [UserFormController::class, 'edit']);
    });

    Route::prefix('routeScanners')->group(function() {
        Route::get('/', [RouteScannerController::class, 'index'])->name('routeScanners');
        Route::get('dataTables', [RouteScannerController::class, 'index']);
        Route::get('preview/{route}', [RouteScannerPreviewController::class, 'index']);
    });

    Route::prefix('routeScannerForm')->group(function() {
        Route::get('{routeScanner}', [RouteScannerFormController::class, 'edit'])->name('routeScannerForm.edit');
        Route::get('/', [RouteScannerFormController::class, 'create'])->name('routeScannerForm.create');
    });

    Route::prefix('routes')->group(function() {
        Route::get('/', [RouteController::class, 'index'])->name('routes');
        Route::get('dataTables', [RouteController::class, 'dataTables']);
    });

    Route::prefix('routeStops')->group(function() {
        Route::get('{routeId}', [RouteStopController::class, 'index'])->name('routeStops');
        Route::get('{routeId}/dataTables', [RouteStopController::class, 'dataTables']);
    });

    Route::prefix('routeIntersections')->group(function() {
        Route::get('{routeId}', [RouteIntersectionController::class, 'index'])->name('routeIntersections');
        Route::get('{routeId}/dataTables', [RouteIntersectionController::class, 'dataTables']);
    });

    Route::prefix('services')->group(function() {
        Route::get('/', [ServiceController::class, 'index'])->name('services');
        Route::get('dataTables', [ServiceController::class, 'dataTables']);
        Route::get('{id}/settings', [ServiceSettingsController::class, 'index']);
    });

});
