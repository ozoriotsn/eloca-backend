<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function () {
    echo'test';
});

/** Companies */
Route::post('companies', [App\Http\Controllers\CompanyController::class, 'store']);
Route::get('companies', [App\Http\Controllers\CompanyController::class, 'index']);
Route::get('companies/{id}', [App\Http\Controllers\CompanyController::class, 'show']);
Route::put('companies/{id}', [App\Http\Controllers\CompanyController::class, 'update']);
Route::delete('companies/{id}', [App\Http\Controllers\CompanyController::class, 'destroy']);


/** Customers */
Route::post('customers', [App\Http\Controllers\CustomerController::class, 'store']);
Route::get('customers', [App\Http\Controllers\CustomerController::class, 'index']);
Route::get('customers/{id}', [App\Http\Controllers\CustomerController::class, 'show']);
Route::put('customers/{id}', [App\Http\Controllers\CustomerController::class, 'update']);
Route::delete('customers/{id}', [App\Http\Controllers\CustomerController::class, 'destroy']);
