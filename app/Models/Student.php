<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\feedback;
use App\Models\Course;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname','gender','phone','img','email','pass' ];


    /**
     * Get the feedbacks of the student.
     */
    public function feedbacks()
    {
        return $this->hasMany(feedback::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }





}
