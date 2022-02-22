<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
   

    {
        DB::table('students')->insert([
            'fname' => 'sara',
            'lname' => 'mohamed',
            'gender' => 'female',
            'phone' => 2368482389,
            'img' => 'sara.jpg',
            'email' => 'sara@gmail.com',
            'pass' => Hash::make('sara'),
    
           
        ]);
        //
    }
}
