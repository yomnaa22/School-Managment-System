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
            'fname' => 'maria',
            'lname' => 'emil',
            'gender' => 'female',
            'phone' => 1355654685,
            'img' => 'maria.jpg',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('12345678'),
            'facebook' => 'facebook.com/maria',
            'twitter' => 'twitter.com/maria',
            'linkedin' => 'linkedin.com/maria',
        ]);
        //
    }
}
