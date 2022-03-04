<?php

namespace Database\Seeders;

use App\Models\Trainer;
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
            'email' => 'maria@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        Trainer::factory()
                ->count(10)
                ->create();
    }
}
