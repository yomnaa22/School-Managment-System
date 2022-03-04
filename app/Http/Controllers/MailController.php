<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendEmail(){
        $details = [
            'title' => 'Mentor Online Courses',
            'body' => 'Congrats! You successfully enrolled in course'
        ];
        Mail::to("mariaemil55@gmail.com")->send(new TestMail($details));
        return "Email Sent Successfully!!";
    }
}
