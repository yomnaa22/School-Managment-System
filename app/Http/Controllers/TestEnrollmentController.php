<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Models\Student;
use App\Notifications\TestEnrollment;
use Illuminate\Support\Facades\Notification;

class TestEnrollmentController extends Controller
{
    public function sendTestNotification()
    {
        $student = Student::first();
        $enrollmentData=[
            'body'=>'you recieved new test notification',
            'enrollmentTest' => 'you allowed to enroll',
            'url'=>url('/'),
            'thankyou' => 'you have 1 days to enroll'
        ];

       // $student->notify(new TestEnrollment($enrollmentData));
       Notification::send($student,new TestEnrollment($enrollmentData));
    }
}
