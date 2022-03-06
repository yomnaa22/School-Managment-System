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
            'name' => 'css',
            'desc' => 'this is final exam for css',
            'student_id' => 1,
            'course_id' => 1,

        ]);
    }
}
