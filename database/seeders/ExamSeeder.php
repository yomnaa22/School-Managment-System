<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   

        DB::table('exams')->insert([
            'name' => 'css',
            'course_id' => 1,
            'max_score' => 3,
            
           

        ]);
    }
}
