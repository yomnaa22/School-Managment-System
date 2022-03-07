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



Route::post('/courses', [CourseController::class, 'store']);
Route::delete('/questions/{id}',[QuestionController::class, 'destroy']);
Route::post('/questions',[QuestionController::class, 'store']);
Route::post('/questions/{id}',[QuestionController::class, 'update']);
// Route::post('/trainers',[TrainerController::class, 'store']);
Route::post('/courses/{id}', [CourseController::class, 'update']);
Route::patch('/courses/{id}', [CourseController::class, 'update']);
Route::post('/Course_content', [CourseContentController::class, 'store']);
Route::put('/Course_content/{id}', [CourseContentController::class, 'update']);
Route::patch('/Course_content/{id}', [CourseContentController::class, 'update']);
Route::delete('/Course_content/{id}', [CourseContentController::class, 'destroy']);
Route::post('/exams',[ExamController::class, 'store']);
Route::delete('/exams/{id}',[ExamController::class, 'destroy']);
Route::post('/exams/{id}',[ExamController::class, 'update']);




//show student by Course id
Route::get('/student/showStudent/{id}', [CourseController::class, 'showStudent']);
