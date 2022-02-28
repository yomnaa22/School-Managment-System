<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('courses')->insert([
            'name' => 'css3',
            'img' => 'courseimg1.jpeg',
            'price' => 200,
            'duration' => 5,
            'desc'=>'css course',
            'preq' =>'prequist',
            'trainer_id' => 1,
            'category_id' => 1,
            
           

        ]);
        
    }
}
