<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Dotenv\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    //

    // public function redirectToGoogle()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // public function handleGoogleCallback()
    // {
    //     try {

    //         $user = Socialite::driver('google')->user();

    //         $finduser = Student::where('google_id', $user->id)->first();

    //         if($finduser){
    //             //Auth::login($finduser);
    //             // Auth::guard('students')->login($finduser);
    //             // return response()->json(['message' => 'Successfully login ']);
    //             return $this->respondWithToken($token);

    //         }else{
    //             $newUser = Student::create([
    //                 'fname' => $user->name,
    //                 'lname' => $user->name,
    //                 'gender' => 'male',
    //                 'phone' => '34567654566',
    //                 'email' => $user->email,
    //                 'google_id'=> $user->id,
    //                 'password' => encrypt('123456dummy')
    //             ]);

    //             // Auth::guard('students')->login($newUser);
    //             // return response()->json(['message' => 'Successfully login ']);
    //             return $this->respondWithToken($token);

    //         }

    //     } catch (Exception $e) {
    //         dd($e->getMessage());
    //     }
    // }


    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'name'=>Auth::guard('students')->user()->fname,
    //         'id'=>Auth::guard('students')->user()->id,
    //         'role'=>'isStudent',
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->guard('students')->factory()->getTTL() * 60
    //     ]);
    // }

}







