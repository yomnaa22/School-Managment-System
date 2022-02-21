<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class contactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_us')->insert([
            'email' => 'web',
            'name' => 'testimg.jpg',
            'subject' =>'html',
            'message' => 'new message',
            'created_at' => Carbon::now(),
           

        ]);
    }
}
