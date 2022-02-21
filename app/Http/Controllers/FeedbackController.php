<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\feedback;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeedbackController extends Controller
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
        $feedback = feedback::get();
        return response()->json($feedback, 200);
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
            $feedback = feedback::create([
                'name' => $request->name,
                'desc' => $request->desc,
                'student_id' => $request->student_id,
                'course_id' => $request->course_id
            ]);

            if ($feedback) {
                // return $this->createdResponse($contact_us);
                return response()->json($feedback, 200);
            }
        }
        // $this->unKnowError();
        return response()->json("Cannot send this feedback", 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feedback = feedback::find($id);
        if ($feedback) {
            // return $this->apiResponse($course);
            return response()->json($feedback, 200);
        }
        // return $this->notFoundResponse();
        return response()->json("Not Found", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $feedback = feedback::find($id);
        if ($feedback) {
            if ($request->isMethod('put')) {
                $validation = $this->validation($request);
                if ($validation instanceof Response) {
                    return $validation;
                }
            }

            $feedback->update($request->all());
            return response()->json($feedback, 200);
        }
        return response()->json("Not found", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $feedback = feedback::find($id);
    //     if (is_null($feedback)) {
    //         return response()->json("Record not found", 404);
    //     }
    //     $feedback->delete();
    //     return response()->json(null, 204);
    // }


    public function validation($request)
    {
        return $this->apiValidation($request, [
            'name' => 'required|min:3',
            'course_id' => 'required|exists:App\Models\Course,id',
            'student_id' => 'required|exists:App\Models\Student,id',
            'desc' => 'required|min:6|max:40'
        ]);
    }
}
