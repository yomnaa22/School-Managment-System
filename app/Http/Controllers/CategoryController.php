<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;



class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $Categorys = Category::get();
        return $this->apiResponse($Categorys);
    }
    public function show($id)
    {
        $Category = Category::find($id);
        if ($Category) {
            return $this->apiResponse($Category);
        }
        return $this->notFoundResponse();
    }

    public function delete($id)
    {
        $Category = Category::find($id);
        if ($Category) {
            $Category->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    public function store(Request $request)
    {

        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $img=$request->file('img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $image="cate -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/categores/"),$image);
        $Categorys = Category::create([
            'name'=>$request->name ,
            'img' =>$image,
        ]);
        if ($Categorys) {
            return $this->createdResponse($Categorys);
        }

        $this->unKnowError();

    }

    public function update($id , Request $request){

        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $Category = Category::find($id);
        if (!$Category) {
            return $this->notFoundResponse();
        }
        $name=$Category->img;
        if ($request->hasFile('img'))
        {
            if($name !== null)
            {
                unlink(public_path('uploads/categores/'.$name));
            }
            //move
        $img=$request->file('img');             //bmsek el soura
        $ext=$img->getClientOriginalExtension();   //bgeb extention
        $name="cate -".uniqid().".$ext";            // conncat ext +name elgded
        $img->move(public_path("uploads/categores"),$name);   //elmkan , $name elgded

        }


        $Category->update([
            'name'=>$request->name ,
            'img' =>$name,
            // $request->all()
        ]);

        if ($Category) {
            return $this->apiResponse($Category);
        }
        $this->unKnowError();
    }

    public function validation($request){
        return $this->apiValidation($request , [
            'name' => 'required|min:3|max:191',
            'img' => 'required|image|mimes:jpeg,png',
        ]);
    }




}
