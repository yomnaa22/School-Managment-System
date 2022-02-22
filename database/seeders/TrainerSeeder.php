<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 

        DB::table('trainers')->insert([
            'fname' => 'ahmed',
            'lname' => 'hamed',
            'gender' => 'male',
            'phone' => 1355654684,
            'img' => 'ahmed.jpg',
            'email' => 'ahmedd@gmail.com',
            'pass' => Hash::make('Ahmnaaaa22'),
            'facebook' => 'facebook.com/ahmed1',
            'twitter' => 'twitter.com/ahmed1',
            'linkedin' => 'linkedin.com/ahmed1',

    
           
        ]);
        //
    }
}
