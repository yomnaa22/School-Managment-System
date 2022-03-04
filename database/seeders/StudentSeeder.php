<?php
namespace Database\Seeders;

use App\Models\Student;
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
            'fname' => 'mahmoud',
            'lname' => 'hamed',
            'gender' => 'female',
            'phone' => 19977234654,
         
            'email' => 'mahmoudawd54@gmail.com',
            'password' => Hash::make('123456789'),
    
           
        ]);

        Student::factory()
                ->count(10)
                ->create();
        //
    }
}
