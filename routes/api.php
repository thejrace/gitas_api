<?php

use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PermissionTypeController;
use App\Http\Controllers\Api\RouteController;
use App\Http\Controllers\Api\RouteIntersectionController;
use App\Http\Controllers\Api\RouteIntersectionServiceController;
use App\Http\Controllers\Api\RouteScannerController;
use App\Http\Controllers\Api\RouteScannerDataController;
use App\Http\Controllers\Api\RouteScannerPoolController;
use App\Http\Controllers\Api\RouteServiceController;
use App\Http\Controllers\Api\RouteStopController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServiceSettingsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserPermissionController;

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

Route::middleware(['auth:api', 'role:admin'])->group(function() {

    Route::resource('users', UserController::class);
    Route::resource('buses', BusController::class);

    Route::resource('permissions', PermissionController::class);
    Route::resource('permission_types', PermissionTypeController::class);

    Route::prefix('user_permissions')->group(function() {
        Route::delete('{user}/{permission}', [UserPermissionController::class, 'revokePermission']);
        Route::post('{user}/{permission}', [UserPermissionController::class, 'givePermission']);
        Route::get('{user}', [UserPermissionController::class, 'getPermissions']);
    });

    Route::prefix('services')->group(function() {
        Route::get('/', [ServiceController::class, 'index']);
        Route::get('{id}', [ServiceController::class, 'show']);
        Route::post('/', [ServiceController::class, 'store']);
        Route::put('{id}', [ServiceController::class, 'update']);
        Route::put('{id}/updateSettings', [ServiceSettingsController::class, 'updateSettings']);
        Route::put('{id}/updateStatus', [ServiceSettingsController::class, 'updateStatus']);
        Route::get('{id}/settings', [ServiceSettingsController::class, 'show']);
        Route::delete('{id}', [ServiceController::class, 'destroy']);
    });

    /* kahya endpoints */
    Route::prefix('routeScanners')->group(function() {
        Route::get('/', [RouteScannerController::class, 'index']);
        Route::get('/{routeScanner}', [RouteScannerController::class, 'show']);
        Route::post('/', [RouteScannerController::class, 'store']);
        Route::put('/{routeScanner}', [RouteScannerController::class, 'update']);
        Route::delete('/{routeScanner}', [RouteScannerController::class, 'destroy']);
    });

    Route::prefix('routes')->group(function() {
        Route::get('/', [RouteController::class, 'index']);
        Route::get('{id}', [RouteController::class, 'show']);
        Route::post('/', [RouteController::class, 'store']);
        Route::put('{id}', [RouteController::class, 'update']);
        Route::delete('{id}', [RouteController::class, 'destroy']);
    });

    Route::prefix('routeStops/{routeId}')->group(function() {
        Route::post('/', [RouteStopController::class, 'storeAsMass']);
    });

    Route::prefix('routeIntersections/{routeId}')->group(function() {
        Route::post('/', [RouteIntersectionController::class, 'storeAsMass']);
    });

    Route::get('downloadRouteScannerData/{route}', [RouteScannerDataController::class, 'download']);

});

Route::post('login', [LoginController::class, 'authenticate']); // retrieve api token

/*
|--------------------------------------------------------------------------
| Service Routes
|--------------------------------------------------------------------------
|
| These routes are for services to access.
|
*/
Route::middleware(['auth:service'])->group(function() {
    Route::prefix('servicePipeline')->group(function() {
        Route::get('{id}/settings', [ServiceSettingsController::class, 'show']);
        Route::put('updateRoutes', [RouteServiceController::class, 'update']);
        Route::put('updateRouteIntersections', [RouteIntersectionServiceController::class, 'update']);

        Route::prefix('routeScanner')->group(function() { // @todo middleware yap bunlari role:routeScanner vs gibi olabilir
            Route::post('uploadRouteScannerData', [RouteScannerDataController::class, 'upload']);
            Route::get('list', [RouteScannerPoolController::class, 'index']);
            Route::get('routeIntersections/{route}', [RouteIntersectionServiceController::class, 'fetch']);
            Route::get('routeStops', [RouteServiceController::class, 'stops']);
        });
    });
});