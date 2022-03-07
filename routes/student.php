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



//get all questions by exam_id
Route::get('/exams/questions/{e_id}',[ExamController::class, 'getAllQestions']);

Route::get('/exams',[ExamController::class, 'index']);
Route::get('/exams/{id}',[ExamController::class, 'show']);

//show Course content by Course id
Route::get('/Course_content/show/{c_id}', [CourseController::class, 'showvideo']);

Route::get('/questions',[QuestionController::class, 'index']);

Route::get('/questions/{id}',[QuestionController::class, 'show']);




Route::get('/students',[StudentController::class, 'index']);

Route::get('/students/{id}',[StudentController::class, 'show']);


//show courses by student id
Route::get('/student/showCourses/{id}', [CourseController::class, 'showCourses']);


//enrolle
Route::post('/student/storeCourse',[CourseController::class,'Enrollment']);



Route::get('/Course_content', [CourseContentController::class, 'index']);
Route::get('/Course_content/{id}', [CourseContentController::class, 'show']);


Route::post('/feedbacks', [FeedbackController::class, 'store']);


//add degree exam
Route::post('/Storedegree',[ExamController::class,'Storedegree']);

//show degree exam
Route::get('/showDegree/{s_id}/{c_id}', [ExamController::class, 'showDegree']);
