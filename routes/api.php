<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\FundManagerController;
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

Route::get('funds/duplicated', [FundController::class, 'getDuplicatedFunds']);

Route::resource('funds', FundController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('managers', FundManagerController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('companies', CompanyController::class)->only([
    'index', 'store', 'show', 'update', 'destroy'
]);
