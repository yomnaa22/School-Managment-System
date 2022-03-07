<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CourseContentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\payment;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;



    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

    Route::get('/admins', [AuthController::class,'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::post('/categories/{id}',[CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

    Route::delete('/trainers/{id}',[TrainerController::class, 'destroy']);
    Route::delete('/students/{id}',[StudentController::class, 'destroy']);

    Route::get('/Contact_us', [ContactUsController::class, 'index']);
    Route::get('/Contact_us/{id}', [ContactUsController::class, 'show']);
    Route::delete('/Contact_us/{id}', [ContactUsController::class, 'destroy']);
    // Route::put('/Contact_us/{id}', [ContactUsController::class, 'update']);
    // Route::patch('/Contact_us/{id}', [ContactUsController::class, 'update']);

    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    
    // Route::put('/feedbacks/{id}', [FeedbackController::class, 'update']);
    // Route::patch('/feedbacks/{id}', [FeedbackController::class, 'update']);





