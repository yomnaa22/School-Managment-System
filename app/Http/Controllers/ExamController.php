<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExamController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $exams = Exam::get();
        return $this->apiResponse($exams);
    }

    public function store(Request $request)
    {
        //
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $exams = Exam::create([
            'name'=>$request->name ,
            'course_id'=>$request->course_id ,
            'questions_id'=>$request->questions_id ,
            'max_score'=>$request->max_score
        ]);
        if ($exams) {
            return $this->createdResponse($exams);
        }

        $this->unKnowError();
    }

    public function show($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            return $this->apiResponse($exam);
        }
        return $this->notFoundResponse();
    }


    public function update(Request $request,$id)
    {
        //
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }

        $exam = Exam::find($id);
        if (!$exam) {
            return $this->notFoundResponse();
        }

        $exam->update([
            'name'=>$request->name ,
            'course_id'=>$request->course_id ,
            'questions_id'=>$request->questions_id ,
            'max_score'=>$request->max_score
        ]);

        if ($exam) {
            return $this->createdResponse($exam);
        }

        $this->unKnowError();

    }

    public function destroy($id)
    {
        $exam = Exam::find($id);
        if ($exam) {
            $exam->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    public function validation($request){
        return $this->apiValidation($request , [
            'name' => 'required|min:3|max:30',
            'course_id' => 'required',
            'questions_id' => 'required',
            'max_score' => 'required',
        ]);
    }


}
