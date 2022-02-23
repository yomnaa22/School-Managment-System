<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Course_Content;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;

class CourseContentController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses_contents = Course_Content::with('course')->get();
        return response()->json($courses_contents, 200);
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
        $validation = $this->validation($request);
        if ($validation instanceof Response) {
            return $validation;
        }
        if (is_null($validation)) {
            $course_content = Course_Content::create([
                'name' => $request->name,
                'content' => $request->content,
                'course_id' => $request->course_id
            ]);
            if ($course_content) {
                // return $this->createdResponse($contact_us);
                return response()->json($course_content, 200);
            }
        }
        // $this->unKnowError();
        return response()->json("Cannot send this message", 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course_Content  $course_Content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course_content = Course_Content::find($id);
        if ($course_content) {
            $course_content->course;
            // return $this->apiResponse($course);
            return response()->json($course_content, 200);
        }
        // return $this->notFoundResponse();
        return response()->json("Not Found", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course_Content  $course_Content
     * @return \Illuminate\Http\Response
     */
    public function edit(Course_Content $course_Content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course_Content  $course_Content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course_content = Course_Content::find($id);
        if ($course_content) {
            if ($request->isMethod('put')) {
                $validation = $this->validation($request);
                if ($validation instanceof Response) {
                    return $validation;
                }
            }


            $course_content->update($request->all());
            return response()->json($course_content, 200);
        }
        return response()->json("Not found", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course_Content  $course_Content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course_content = Course_Content::find($id);
        if (is_null($course_content)) {
            return response()->json("Record not found", 404);
        }
        $course_content->delete();
        return response()->json(null, 204);
    }


    public function validation($request)
    {
        return $this->apiValidation($request, [
            'name' => 'required|min:3|max:20',
            'course_id' => 'required|exists:App\Models\Course,id',
            'content' => 'required|min:3'
        ]);
    }
}
