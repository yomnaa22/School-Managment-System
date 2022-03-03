<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Mail\welcomemail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;

use App\Http\Controllers\TestEnrollmentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    Mail::to('yuumnaa59@gmail.com')->send(new welcomemail());
    return new welcomemail();
});


Route::get('/send-testenrollment',[TestEnrollmentController::class, 'sendTestNotification']);

//Route::get('/courses/search_course', [CourseController::class, 'searchCourse']);
