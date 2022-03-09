<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\question;
use App\Models\Course;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id','max_score'];

    public function questions()
    {
        return $this->hasMany(question::class);
    }
   
    public function course()
    {
        return $this->belongsTo(Course::class);
    }


}
