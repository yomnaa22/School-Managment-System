<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $exams = Exam::get();
        return $this->apiResponse($exams);
    }

    public function getallExam($e_id)
    {
        //$exam = Exam::find($e_id);
        // $question = question::find($q_id);
        // $exam=DB::table('exams')->where('id' , $e_id)->where('questions_id' , $q_id);

        // $exam = DB::table('exams')
        // ->select('*')
        // ->join('exams', "questions.$q_id", '=', "exams.$e_id")
        // ->get();

        // $exam= DB::table('exams')
        // ->select('*')
        // ->join('questions', 'exams.id', 'questions.id')
        // ->where('e_id','=', $e_id)
        // ->where('questions_id','=',$q_id)
        // ->get();

        // $exam['question']=question::findOrFail($q_id);
        // $exam['Exam']=Exam::where('id',$q_id)->get();

        //$exam=Exam::with('question')->get();

        // $exam['question']=question::where('id',$q_id)->get();

        // $exam = DB::table('exams')
        //     ->leftJoin('exams', 'exams.e_id', '=', 'questions.q_id')
        //     ->get();

        // $exam =DB::table('exams')
        // ->select('*')
        // ->join('questions', 'exams.id', '=', 'questions.id')
        // ->where('exams.id', $q_id)
        // ->get();
        $exam=Exam::with('course')->find($e_id);
        // $exam = Exam::find($q_id)->questions;

        if ($exam) {

            return $this->apiResponse($exam);
        }
        return $this->notFoundResponse();


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
        $exam = Exam::with('course')->find($id);
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
