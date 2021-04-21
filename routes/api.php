<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

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

Route::group(['prefix' => 'customers'], function () {
  Route::get('', [CustomersController::class, 'index']);
  Route::post('create', [CustomersController::class, 'store']);
  Route::get('show/{id}', [CustomersController::class, 'getCustomer']);
  Route::put('update/{id}', [CustomersController::class, 'update']);
  Route::delete('delete/{id}', [CustomersController::class, 'delete']);
});
