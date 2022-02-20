<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    
    /**
     * Get the courses for this trainer.
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
