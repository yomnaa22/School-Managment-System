<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam ;

class question extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['header', 'choice_1','choice_2','choice_3','choice_4','answer','score' , 'exam_id'];
=======
    protected $fillable = ['header', 'choice_1','choice_2','choice_3','choice_4','answer','score' ,'exam_id'];
>>>>>>> b1e7b2e6f69a6035c9730a4c78fa3ba354c8cfa4


    public function exam()
    {
        return $this->belongsTo(Exam::class);
 
    }



}
