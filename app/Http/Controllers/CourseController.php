<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Courses=Course::with('category','trainer')->get();
        // $Courses = Course::get();
        return response()->json($Courses, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $image = "course -" . uniqid() . ".$ext";
        $img->move(public_path("uploads/courses/"), $image);

        $course = Course::create([
            'name' => $request->name,
            'img' => $image,
            'category_id' => $request->category_id,
            'trainer_id' => $request->trainer_id,
            'price' => $request->price,
            'duration' => $request->duration,
            'preq' => $request->preq,
            'desc' => $request->desc,
        ]);

        if ($course) {
            // return $this->createdResponse($course);
            return response()->json($course, 200);
        }
    
        // $this->unKnowError();
        return response()->json("Cannot add this course", 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course=Course::with('category','trainer')->find($id);
        // $course = Course::find($id);
        if ($course) {
            // return $this->apiResponse($course);
            return response()->json($course, 200);
        }
        // return $this->notFoundResponse();
        return response()->json("Not Found", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course) {

            if ($request->isMethod('put')) {
                $validation = $this->validation($request);
                if ($validation instanceof Response) {
                    return $validation;
                }
            }

            // if (!$course) {
            //     return $this->notFoundResponse();
            // }
            $name = $course->img;
            if ($request->hasFile('img')) {
                if ($name !== null) {
                    unlink(public_path('uploads/courses/' . $name));
                }
                //move
                $img = $request->file('img');             //bmsek el soura
                $ext = $img->getClientOriginalExtension();   //bgeb extention
                $name = "course -" . uniqid() . ".$ext";            // conncat ext +name elgded
                $img->move(public_path("uploads/courses"), $name);   //elmkan , $name elgded

            }


            $course->update([
                'name' => $request->name,
                'img' => $name,
                'category_id' => $request->category_id,
                'trainer_id' => $request->trainer_id,
                'price' => $request->price,
                'duration' => $request->duration,
                'preq' => $request->preq,
                'desc' => $request->desc,
            ]);
            return response()->json($course, 200);
            // if ($course) {
            //     return $this->apiResponse($course);

            // }
        }
        // $this->unKnowError();
        return response()->json("Record not found", 404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            return response()->json("Record not found", 404);
        }
        $course->delete();
        return response()->json(null, 204);
    }

    public function validation($request)
    {
        return $this->apiValidation($request, [
            'name' => 'required|min:3|max:20',
            'img' => 'required|image|mimes:jpeg,png',
            'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'trainer_id' => 'required|exists:App\Models\Trainer,id',
            'duration' => 'required',
            // 'preq'
            'desc' => 'required|min:3'
        ]);
    }
}
