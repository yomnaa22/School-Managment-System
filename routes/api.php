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
use App\Http\Controllers\chatController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\payment;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;


use Illuminate\Support\Facades\Route;

Route::post('messages', [chatController::class, 'message']);
//login Admin
Route::post('login', 'App\Http\Controllers\AuthController@login')->middleware(['cors']);
Route::post('register', 'App\Http\Controllers\AuthController@register');


//register student
Route::post('/students',[StudentController::class,'register']);
//login student
Route::post('login/student', [StudentController::class, 'login']);

//gurad students
Route::middleware('checkStudent:students')->group(function () {

    Route::post('/student/me', [StudentController::class, 'me']);
    Route::post('/student/logout', [StudentController::class, 'logout']);
    Route::post('/student/hello', [StudentController::class, 'sayHello']);

    Route::post('/students/{id}',[StudentController::class, 'update']);


});


Route::post('payment-intent', [PaymentController::class,'CreatePayIntent']);
Route::post('store-intent', [PaymentController::class,'storeStripePayment']);

//register trainer
Route::post('/trainers/register', [TrainerController::class, 'register']);
//login trainer
Route::post('/trainers/login', [TrainerController::class, 'login']);
//gurad triner
Route::middleware('checkTrainer:triners')->group(function () {

    Route::post('/trainers/me', [TrainerController::class, 'me']);

    Route::post('/trainers/logout', [TrainerController::class, 'logout']);
    Route::post('/trainers/hello', [TrainerController::class, 'sayHello']);

    Route::post('/trainers/{id}',[TrainerController::class, 'update']);


});

//get categories count
Route::get('/categories/count',[CategoryController::class,'getCount']);
//get courses count
Route::get('/courses/count',[CourseController::class,'getCount']);
//get students count
Route::get('/students/count',[StudentController::class,'getCount']);
//get trainers count
Route::get('/trainers/count',[TrainerController::class,'getCount']);

//get categories
Route::get('/categories', [CategoryController::class, 'index']);
//get categories by id
Route::get('/categories/{id}', [CategoryController::class, 'show']);
// get courses of specific category
Route::get('/categories/courses/{id}', [CategoryController::class, 'showCategoryCourses']);
//get trainers
Route::get('/trainers',[TrainerController::class, 'index']);
//get trainers by id
Route::get('/trainers/{id}',[TrainerController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::post('/Contact_us', [ContactUsController::class, 'store']);
// return student count in given course id
Route::get('/student/studentCount/{id}', [CourseController::class, 'studentCount']);
Route::get('/feedbacks', [FeedbackController::class, 'index']);
//Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);
// Route::delete('/feedbacks/{id}',[FeedbackController::class, 'destroy']);


Route::post('messages', [chatController::class, 'message']);

Route::post('/studentcourseenroll', [CourseController::class, 'course_student_enroll']);



