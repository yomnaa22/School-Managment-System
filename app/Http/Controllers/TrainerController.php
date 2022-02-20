<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class TrainerController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //
        $trainers = Trainer::get();
        return $this->apiResponse($trainers);
    }

    public function store(Request $request)
    {
        //
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $img=$request->file('img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $image="train -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/trainer/"),$image);


        $trainers = Trainer::create([
            'fname'=>$request->fname ,
            'lname'=>$request->lname ,
            'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            'img'=>$image,
            'email'=>$request->email ,
            'pass'=>Hash::make($request->pass),
            'facebook'=>$request->facebook ,
            'twitter'=>$request->twitter ,
            'linkedin'=> $request->linkedin ,
        ]);
        if ($trainers) {
            return $this->createdResponse($trainers);
        }

        $this->unKnowError();
    }

    public function show($id)
    {
        $trainer = Trainer::find($id);
        if ($trainer) {
            return $this->apiResponse($trainer);
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
                'facebook' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
            ]);
        if($validation instanceof Response){
            return $validation;
        }

        $trainer = Trainer::find($id);
        if (!$trainer) {
            return $this->notFoundResponse();
        }


        $name=$trainer->img;
        if ($request->hasFile('img'))
        {
            if($name !== null)
            {
                unlink(public_path('uploads/trainer/'.$name));
            }
            //move
        $img=$request->file('img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $name="train -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/trainer"),$name);   //elmkan , $name elgded

        }

        $trainer->update([
            'fname'=>$request->fname ,
            'lname'=>$request->lname ,
            'gender'=>$request->gender ,
            'phone'=>$request->phone ,
            'img'=>$name,
            'email'=>$request->email ,
            'pass'=>Hash::make($request->pass),
            'facebook'=>$request->facebook ,
            'twitter'=>$request->twitter ,
            'linkedin'=> $request->linkedin ,
        ]);

        if ($trainer) {
            return $this->createdResponse($trainer);
        }

        $this->unKnowError();

    }

    public function destroy($id)
    {
        $trainer = Trainer::find($id);
        if ($trainer) {
            $trainer->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    public function validation($request){
        return $this->apiValidation($request , [
            'fname' => 'required|min:3|max:10',
            'lname' => 'required|min:3|max:10',
            'gender' => 'required|',
            'phone' => 'required|unique:trainers',
            'img' => 'required|image|mimes:jpeg,png',
            'email' => 'required|email|unique:trainers',
            'pass' => 'required|min:6|',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
        ]);
    }


}
