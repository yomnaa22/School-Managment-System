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
        'choice_1' => 'choice_1',
        'choice_2' => 'choice_2',
        'choice_3' => 'choice_3',
        'choice_4' => 'choice_4',
        'answer' => 'answer',
        'score' => 10,
        'exam_id' => 1,
    ]);

    }
}
