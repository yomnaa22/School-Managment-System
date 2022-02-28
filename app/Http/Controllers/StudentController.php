<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'pass'=>Hash::make($request->pass),
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
                'fname' => 'required|min:3|max:10',
                'lname' => 'required|min:3|max:10',
                'gender' => 'required|',
                'phone' => 'required|min:10',
                'img' => 'required|image|mimes:jpeg,png',
                'email' => 'required|email',
                'pass' => 'required|min:6|',
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
            'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            'img'=>$name,
            'email'=>$request->email ,
            'pass'=>Hash::make($request->pass),
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


    public function validation($request){
        return $this->apiValidation($request , [
            'fname' => 'required|min:3|max:10',
            'lname' => 'required|min:3|max:10',
            'gender' => 'required|',
            'phone' => 'required|unique:students',
            'img' => 'required|image|mimes:jpeg,png',
            'email' => 'required|email|unique:students',
            'pass' => 'required|min:6|',
        ]);
    }


}
