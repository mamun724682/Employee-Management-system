<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth')->group(function (){
    Route::get('/employees/countries', [\App\Http\Controllers\Api\EmployeeDataController::class, 'countries']);
    Route::get('/employees/{country}/states', [\App\Http\Controllers\Api\EmployeeDataController::class, 'states']);
    Route::get('/employees/{state}/cities', [\App\Http\Controllers\Api\EmployeeDataController::class, 'cities']);
    Route::get('/employees/departments', [\App\Http\Controllers\Api\EmployeeDataController::class, 'departments']);

    Route::apiResource('employees', \App\Http\Controllers\Api\EmployeeController::class);
//});
