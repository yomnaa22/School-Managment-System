<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TrainerController;
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


Route::get('/categories',[CategoryController::class, 'index']);
Route::get('/categories/{id}',[CategoryController::class, 'show']);
Route::delete('/categories/{id}',[CategoryController::class, 'delete']);
Route::post('/categories',[CategoryController::class, 'store']);
Route::post('/categories/{id}',[CategoryController::class, 'update']);


Route::get('/questions',[QuestionController::class, 'index']);
Route::get('/questions/{id}',[QuestionController::class, 'show']);
Route::delete('/questions/{id}',[QuestionController::class, 'destroy']);
Route::post('/questions',[QuestionController::class, 'store']);
Route::post('/questions/{id}',[QuestionController::class, 'update']);


Route::get('/trainers',[TrainerController::class, 'index']);
Route::get('/trainers/{id}',[TrainerController::class, 'show']);
Route::delete('/trainers/{id}',[TrainerController::class, 'destroy']);
Route::post('/trainers',[TrainerController::class, 'store']);
Route::post('/trainers/{id}',[TrainerController::class, 'update']);
