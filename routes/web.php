<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::get('users/deleted', [\App\Http\Controllers\Backend\UserController::class, 'deletedUsers'])->name('users.deleted');
    Route::get('users/restore/{user}', [\App\Http\Controllers\Backend\UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/delete/{user}/permanently', [\App\Http\Controllers\Backend\UserController::class, 'deletePermanently'])->name('users.delete.permanently');
    Route::put('users/change/{user}/password', [\App\Http\Controllers\Backend\UserController::class, 'changePassword'])->name('users.change.password');
    Route::resource('users', \App\Http\Controllers\Backend\UserController::class)->except('show');

    //Country
    Route::resource('countries', \App\Http\Controllers\Backend\CountryController::class)->except('show', 'create', 'edit');
    //State
    Route::resource('states', \App\Http\Controllers\Backend\StateController::class)->except('show', 'create', 'edit');
    //City
    Route::resource('cities', \App\Http\Controllers\Backend\CityController::class)->except('show', 'create', 'edit');
    //Department
    Route::resource('departments', \App\Http\Controllers\Backend\DepartmentController::class)->except('show', 'create', 'edit');

    //Department
    Route::get('{any}', function (){
        return view('employees.index');
    })->where('{any}', '.*');
});
