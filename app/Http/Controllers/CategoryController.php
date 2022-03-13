<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class CategoryController extends Controller
{
    use ApiResponseTrait;



    public function index()
    {
        $Categorys = Category::with('courses')->get();
        return $this->apiResponse($Categorys);
    }

    public function show($id)
    {
        $Category = Category::with('courses')->find($id);
        if ($Category) {
            return $this->apiResponse($Category);
        }
        return $this->notFoundResponse();
    }

    public function showCategoryCourses($id)
    {
        $courses = DB::table('categories')
            ->join('courses', 'categories.id', '=', 'courses.category_id')
            ->where('categories.id', '=', $id)
            ->join('trainers', 'trainers.id', '=', 'courses.trainer_id')
            ->select( 'courses.*', 'categories.name as c_name', 'trainers.*', 'courses.img as c_img')
            ->get();
        if ($courses) {
            return response()->json($courses, 200);
        }
        return response()->json("No courses found in this category", 404);
    }

    public function delete($id)
    {
        $Category = Category::find($id);
        if ($Category) {
            $img_name = $Category->img;
        // if ($course->hasFile('img')) {
        if ($img_name !== null) {
            // unlink(public_path('uploads/courses/' . $img_name));
            $path_parts = pathinfo(basename($img_name));
                
            Cloudinary::destroy($path_parts['filename']);
        }
            $Category->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    // public function store(Request $request)
    // {

    //     $validation = $this->validation($request);
    //     if($validation instanceof Response){
    //         return $validation;
    //     }

    //     $img=$request->file('img');             //bmsek el soura
    //     $ext=$img->getClientOriginalExtension();   //bgeb extention
    //     $image="cate -".uniqid().".$ext";            // conncat ext +name elgded
    //     $img->move(public_path("uploads/categores/"),$image);
    //     $Categorys = Category::create([
    //         'name'=>$request->name ,
    //         'img' =>$image,
    //     ]);
    //     // if ($Categorys) {
    //     //     return $this->createdResponse($Categorys);
    //     // }

    //     // $this->unKnowError();
    //     if ($Categorys) {
    //         // return $this->createdResponse($contact_us);
    //         return response()->json($Categorys, 200);
    //     }

    // // $this->unKnowError();
    //         return response()->json("Cannot send this message", 400);

    //         }


    public function store(Request $request)
    {

        $validation = $this->validation($request);
        if ($validation instanceof Response) {
            return $validation;
        }
        //$image = Cloudinary::upload($request->file('img')->getRealPath())->getSecurePath();
        $image = cloudinary()->upload($request->file('img')->getRealPath())->getSecurePath();
     //  dd($image->public_id);
    
       //dd($uploadedFileUrl);
        $name = $request->name;
        // $img = $request->file('img');             //bmsek el soura
        // $ext = $img->getClientOriginalExtension();   //bgeb extention
        // $image = "cate -" . uniqid() . ".$ext";            // conncat ext +name elgded
        // $img->move(public_path("uploads/categores/"), $image);
        $Categorys = Category::create([
            'name' => $name,
            'img' => $image
        ]);
        // if ($Categorys) {
        //     return $this->createdResponse($Categorys);
        // }

        // $this->unKnowError();
        if ($Categorys) {
            // return $this->createdResponse($contact_us);
            return response()->json($Categorys, 200);
        }

        // $this->unKnowError();
        return response()->json("Cannot send this message", 400);
    }



    public function update($id, Request $request)
    {

        $validation = $this->apiValidation($request, [
            'name' => 'required|min:3|max:30',
            'img' => 'image|mimes:jpg,jpeg,png',
        ]);
        if ($validation instanceof Response) {
            return $validation;
        }

        // $validation = $this->validation($request);
        // if ($validation instanceof Response) {
        //     return $validation;
        // }

        $Category = Category::find($id);
        if (!$Category) {
            return $this->notFoundResponse();
        }
        $image = $Category->img;
        if ($request->hasFile('img')) {
            if ($image !== null) {
                // unlink(public_path('uploads/categores/' . $name));
                $path_parts = pathinfo(basename($image));
                
                Cloudinary::destroy($path_parts['filename']);
            }
            //move
            // $img = $request->file('img');             //bmsek el soura
            // $ext = $img->getClientOriginalExtension();   //bgeb extention
            // $name = "cate -" . uniqid() . ".$ext";            // conncat ext +name elgded
            // $img->move(public_path("uploads/categores"), $name);   //elmkan , $name elgded
            $image = Cloudinary::upload($request->file('img')->getRealPath())->getSecurePath();
           
        }

        $Category->update([
            'name' => $request->name,
            'img' => $image,
            // $request->all()
        ]);

        if ($Category) {
            return $this->apiResponse($Category);
        }
        $this->unKnowError();
    }

    public function getCount()
    {
        $data = DB::table('categories')->select('id')->count('id');
        if ($data == 0)
            return response()->json($data, 200);
        if ($data) {
            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }

    // public function getCourses($id)
    // {
    //     $Category = Category::with('courses')->find($id);
    //     if ($Category) {
    //         return $this->apiResponse($Category);
    //     }
    //     return $this->notFoundResponse();
    // }


    public function validation($request)
    {
        return $this->apiValidation($request, [
            'name' => 'required|min:3|max:30',
            'img' => 'required|image|mimes:jpg,jpeg,png',
        ]);
    }
}
