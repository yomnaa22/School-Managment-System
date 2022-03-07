<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class feedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    

        DB::table('feedback')->insert([
            'name' => 'Maria',
            'desc' => 'Thanks for this great course',
            'student_id' => 2,
            'course_id' => 3,
           
        ]);
    }
}
