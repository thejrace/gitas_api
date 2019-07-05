<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BusController;
use App\Http\Controllers\Api\UserBusDefinitionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EmployeeRoleController;
use App\Http\Controllers\Api\EmploymentStatusController;




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

Route::middleware(['auth:api'])->group(function(){

    Route::resource('buses', BusController::class );
    Route::resource('user_bus_definitions', UserBusDefinitionController::class );
    Route::resource('users', UserController::class );
    Route::resource('employee_roles', EmployeeRoleController::class );
    Route::resource('employement_status', EmploymentStatusController::class );

});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
