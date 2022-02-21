<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'student_id', 'course_id'];


    /**
     * Get the course that owns the feedback.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    /**
     * Get the student that owns the feedback.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
