<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RestoController;

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

Route::get('resto', [RestoController::class, 'index']);
Route::post('resto/store', [RestoController::class, 'store']);
Route::post('resto/login', [RestoController::class, 'login']);
Route::post('resto/register2', [RestoController::class, 'register2']);
Route::post('resto/register3', [RestoController::class, 'register3']);
Route::get('resto/show/{id}', [RestoController::class, 'show']);
Route::post('resto/update/{id}', [RestoController::class, 'update']);
Route::get('resto/destroy/{id}', [MahasiswaController::class, 'destroy']);
Route::middleware('auth:api')->get('/user', function (Request $request)
 {
    return $request->user();
});
