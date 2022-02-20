<?php

use App\Http\Controllers\CategoryController;
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


Route::get('/categores',[CategoryController::class, 'index']);
Route::get('/categores/{id}',[CategoryController::class, 'show']);
Route::delete('/categores/{id}',[CategoryController::class, 'delete']);
Route::post('/categores',[CategoryController::class, 'store']);
Route::put('/categores/{id}',[CategoryController::class, 'update']);



