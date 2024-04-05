<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BodyController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\TransactionController;

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

// Route::get('test',function(){
//     $name = DB::connection()->table('Users')->get();

//     return $name;
// });

Route::resource('login',LoginController::class);
Route::resource('user',RegisterController::class);
Route::resource('company',CompanyController::class);
Route::resource('car',CarController::class);
Route::resource('bodytype',BodyController::class);
Route::resource('fuel',FuelController::class);
Route::resource('transaction',TransactionController::class);


