<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class questionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
    

    DB::table('questions')->insert([
        'header' => 'question1',
        'choice_1' => 'answer1',
        'choice_2' => 'answer1',
        'choice_3' => 'answer1',
        'choice_4' => 'answer1',
        'answer' => 'answer1',
        'score' => 20,
       

       
    ]);
        //
    }
}
