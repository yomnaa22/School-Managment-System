<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;


class Course_ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course__contents')->insert([
            'name' => 'css',
            'content' => 'this is course contnt',
            'course_id' => 2
           

        ]);
    }
}
