<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\welcomemail;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Student;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class MailController extends Controller
{
    public function sendEmail()
    {

// $details=[
//     'title' => 'Mail from online courses',
//     'body' => 'registration',
// ];

// $emails = DB::table('students')-> pluck('email');
// var_dump($emails);
// foreach($emails as $email){
// Mail::to($email)->send(new welcomemail($details));
// }

    }
}
