<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname','gender','phone','img','email','pass' ,'facebook' , 'twitter' ,'linkedin' ];

}
