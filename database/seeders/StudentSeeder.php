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
            'fname' => 'yomna',
            'lname' => 'hamed',
            'gender' => 'female',
            'phone' => 1251564684,
            'img' => 'yomna.jpg',
            'email' => 'yomna@gmail.com',
            'pass' => Hash::make('Yomnaaaa22'),
    
           
        ]);
        //
    }
}
