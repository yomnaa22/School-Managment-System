<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
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


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::delete('/categories/{id}', [CategoryController::class, 'delete']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::post('/categories/{id}', [CategoryController::class, 'update']);


Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
Route::post('/courses', [CourseController::class, 'store']);
Route::post('/courses/{id}', [CourseController::class, 'update']);
Route::patch('/courses/{id}', [CourseController::class, 'update']);


Route::get('/Contact_us', [ContactUsController::class, 'index']);
Route::get('/Contact_us/{id}', [ContactUsController::class, 'show']);
Route::delete('/Contact_us/{id}', [ContactUsController::class, 'destroy']);
Route::post('/Contact_us', [ContactUsController::class, 'store']);
Route::put('/Contact_us/{id}', [ContactUsController::class, 'update']);
Route::patch('/Contact_us/{id}', [ContactUsController::class, 'update']);



Route::get('/Course_content', [CourseContentController::class, 'index']);
Route::get('/Course_content/{id}', [CourseContentController::class, 'show']);
Route::delete('/Course_content/{id}', [CourseContentController::class, 'destroy']);
Route::post('/Course_content', [CourseContentController::class, 'store']);
Route::put('/Course_content/{id}', [CourseContentController::class, 'update']);
Route::patch('/Course_content/{id}', [CourseContentController::class, 'update']);


Route::get('/feedbacks', [FeedbackController::class, 'index']);
Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
// Route::delete('/feedbacks/{id}',[FeedbackController::class, 'destroy']);
Route::post('/feedbacks', [FeedbackController::class, 'store']);
Route::put('/feedbacks/{id}', [FeedbackController::class, 'update']);
Route::patch('/feedbacks/{id}', [FeedbackController::class, 'update']);
