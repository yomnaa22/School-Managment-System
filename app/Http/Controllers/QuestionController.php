<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Exam;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class QuestionController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        //
        $questions = question::get();
        return $this->apiResponse($questions);
    }

    public function store(Request $request)
    {
        //
        $validation = $this->validation($request);
        if($validation instanceof Response){
            return $validation;
        }
        //get all exam

        $roles=$request->exam_id;
        $questions = question::create([
            'header'=>$request->header ,
            'choice_1'=>$request->choice_1 ,
            'choice_2'=>$request->choice_2 ,
            'choice_3'=>$request->choice_3 ,
            'choice_4'=>$request->choice_4 ,
            'answer'=>$request->answer ,
            'score'=>$request->score
        ]);

        $questions->exam()->attach($roles);

        if ($questions) {
            return $this->createdResponse($questions);
        }

        $this->unKnowError();
    }

    public function show($id)
    {
        $question = question::find($id);
        if ($question) {
            return $this->apiResponse($question);
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
        $question = question::find($id);
        if (!$question) {
            return $this->notFoundResponse();
        }
        $roles=$request->exam_id;
        $question->update([
            'header'=>$request->header ,
            'choice_1'=>$request->choice_1 ,
            'choice_2'=>$request->choice_2 ,
            'choice_3'=>$request->choice_3 ,
            'choice_4'=>$request->choice_4 ,
            'answer'=>$request->answer ,
            'score'=>$request->score
        ]);

        $question->exam()->attach($roles);

        if ($question) {
            return $this->createdResponse($question);
        }

        $this->unKnowError();

    }

    public function destroy($id)
    {
        $question = question::find($id);
        if ($question) {
            $question->delete();
            return $this->deleteResponse();
        }
        return $this->notFoundResponse();
    }


    public function validation($request){
        return $this->apiValidation($request , [
            'header' => 'required|min:3|max:30',
            'choice_1' => 'required|min:3|max:30',
            'choice_2' => 'required|min:3|max:30',
            'choice_3' => 'required|min:3|max:30',
            'choice_4' => 'required|min:3|max:30',
            'answer' => 'required|min:3|max:30',
            'score' => 'required|numeric',
            'exam_id' =>'numeric|exists:App\Models\Exam,id'
        ]);
    }


}
