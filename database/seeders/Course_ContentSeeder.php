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
            'name' => 'week 1',
            'content' => 'https://www.youtube.com/embed/tgbNymZ7vqY',
            'course_id' => 1
        ]);
        DB::table('course__contents')->insert([
            'name' => 'week 2',
            'content' => 'https://www.youtube.com/embed/tgbNymZ7vqY',
            'course_id' => 1
        ]);
        DB::table('course__contents')->insert([
            'name' => 'week 3',
            'content' => 'https://www.youtube.com/embed/tgbNymZ7vqY',
            'course_id' => 1
        ]);
    }
}
