<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam ;

class question extends Model
{
    use HasFactory;

    protected $fillable = ['header', 'choice_1','choice_2','choice_3','choice_4','answer','score' ,'exam_id'];


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }


}
