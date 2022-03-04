<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //
        $students = Student::get();
        return $this->apiResponse($students);
    }

    public function store(Request $request)
    {
        //
       

        // $img=$request->file('img');             //bmsek el soura
        // $ext=$img->getClientOriginalExtension();   //bgeb extention
        // $image="stu -".uniqid().".$ext";            // conncat ext +name elgded
        // $img->move(public_path("uploads/students/"),$image);


        $students = Student::create([
            'fname'=>$request->fname ,
            'lname'=>$request->lname ,
            'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            // 'img'=>$image,
            'email'=>$request->email ,
            'password'=>Hash::make($request->password),
        ]);
        if ($students) {
            return $this->createdResponse($students);
        }

        $this->unKnowError();
    }

    public function register(Request $request)
    {
        //
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }
        // dd($request);

       $students = Student::create([
            'fname'=>$request->fname ,
            'lname'=>$request->lname ,
            'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            'email'=>$request->email ,
            'password'=>Hash::make($request->password),
        ]);
        if ($students) {
            return $this->createdResponse($students);
        }

        $this->unKnowError();
    }



    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            return $this->apiResponse($student);
        }
        return $this->notFoundResponse();
    }
    public function update(Request $request,$id)
    {
        $validation=$this->apiValidation($request , [
                'fname' => 'required|min:3|max:20',
                'lname' => 'required|min:3|max:20',
                // 'gender' => 'required|',
                'phone' => 'required|min:10',
                'img' => 'image|mimes:jpeg,png',
                // 'email' => 'required|email',
                // 'password' => 'required|min:6|',
            ]);
        if($validation instanceof Response){
            return $validation;
        }

        $student = Student::find($id);
        if (!$student) {
            return $this->notFoundResponse();
        }


        $name=$student->img;
        if ($request->hasFile('img'))
        {
            if($name !== null)
            {
                unlink(public_path('uploads/students/'.$name));
            }
            //move
        $img=$request->file('img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $name="stu -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/students"),$name);   //elmkan , $name elgded

        }

        $student->update([
            'fname'=>$request->fname ,
            'lname'=>$request->lname ,
            // 'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            'img'=>$name,
            // 'email'=>$request->email ,
            // 'password'=>Hash::make($request->password),
        ]);

        if ($student) {
            return $this->createdResponse($student);
        }

        $this->unKnowError();

    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    public function getCount()
    {
        $data = DB::table('students')->select('id')->count('id');
        if ($data == 0)
            return response()->json($data, 200);
        if ($data) {
            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }

    public function validation($request){
        return $this->apiValidation($request , [
            'fname' => 'required|min:3|max:20',
            'lname' => 'required|min:3|max:20',
            'gender' => 'required|',
            'phone' => 'required|unique:students',
            'email' => 'required|email|unique:students',
            'password' => 'required|min:6|',
        ]);
    }

    public function login(Request $request)
    {
        $validator = $this->apiValidation($request , [
            'email' => 'required|exists:students,email' ,
            'password' => 'required|string' ,
        ]);

        if($validator instanceof Response){
            return $validator;
        }
        $credentials = request(['email', 'password']);
        if (!$token = auth()->guard('students')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);

    }


    public function me()
    {
        return response()->json(auth()->guard('students')->user());
    }


    public function logout()
    {
        auth()->guard('students')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('students')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'id'=>Auth::guard('students')->user()->id,
            'role'=>'isStudent',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('students')->factory()->getTTL() * 60,
            'id'=>Auth::guard('students')->user()->id,
            'role'=>'isStudent',

        ]);
    }

    public function sayHello(){
        return response()->json('hello students');
    }


    function get_guard(){
        if(Auth::guard('admins')->check())
        {return "admins";}
        elseif(Auth::guard('students')->check())
        {return "students";}
        // elseif(Auth::guard('clients')->check())
        // {return "client";}
    }












}
