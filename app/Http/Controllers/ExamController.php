<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use App\Models\Course;

use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $exams = Exam::with('course')->get();
        return $this->apiResponse($exams);
    }

    public function getallExamOfCourse($c_id)
    {
        $exams = Course::with('exams')->find($c_id);
       
       
       if ($exams) {
            return $this->apiResponse($exams);
        }
        
        return $this->notFoundResponse();

    }

    public function getallExam($c_id)
    {
       // $exam_id = Exam::with('course')->find($c_id);

        $exam = DB::table('exams')
        ->join('courses', 'courses.id', '=', 'exams.course_id')
        ->join('questions','exams.id' , '=','questions.exam_id')
        ->where('courses.id', '=', $c_id)
        ->select( 'exams.*','questions.*',)
        ->get();
       
       if ($exam) {
            return $this->apiResponse($exam);
        }
        
        return $this->notFoundResponse();

    }

    public function getAllQestions($e_id)
    {

        $exam=Exam::with('questions')->find($e_id);
        // $exam = Exam::find($q_id)->questions;

        if ($exam) {

            return $this->apiResponse($exam);
        }
        return $this->notFoundResponse();

    }



    public function Storedegree(Request $request)
    {
        $score = DB::table('student_subject_exam')->insert([
            'student_id' => $request->student_id,
            'exam_id' => $request->exam_id,
            'degree' =>$request->degree
        ]);
        if ($score) {
            return response()->json($score ,200);
        }

        return response()->json("Cannot add this course", 400);

    }

    public function showDegree($s_id,$c_id)
    {

        $degree = DB::table('student_subject_exam')
        ->select('*')
        ->where('student_id', $s_id)
        ->where('course_id', $c_id)
        ->get();

        if ($degree) {
            return response()->json($degree, 200);
        }

        return response()->json("Cannot add this course", 400);

    }

    public function getResult($exam_id,$student_id)
    {
        $degree = DB::table('student_subject_exam')
        ->where
        ([
            ['student_id', '=', $student_id],
			
            ['exam_id', '=', $exam_id],
			
        ])->get()->first();

        if ($degree) {
            return response()->json($degree ,200);
        }

        return response()->json("Cannot add this course", 400);

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
            // 'questions_id'=>$request->questions_id ,
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
            // 'questions_id'=>$request->questions_id ,
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
            'course_id' => 'required|exists:App\Models\Course,id',
            // 'questions_id' => 'required|exists:App\Models\question,id',
            'max_score' => 'required',
        ]);
    }


}
