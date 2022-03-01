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
            'fname' => 'yomnayomna',
            'lname' => 'hamedd',
            'gender' => 'female',
            'phone' => 1251544654,
            'img' => 'yomna.jpg',
            'email' => 'yommnaa@gmail.com',
            'pass' => Hash::make('Yomnaaaa22'),
    
           
        ]);
        //
    }
}
