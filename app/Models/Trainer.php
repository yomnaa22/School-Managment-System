<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname','gender','phone','img','email','pass' ,'facebook' , 'twitter' ,'linkedin' ];


    /**
     * Get the courses for this trainer.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
