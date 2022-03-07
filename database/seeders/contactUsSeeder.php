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
            'email' => 'anonymous@gmail.com',
            'name' => 'anonymous user',
            'subject' =>'html',
            'message' => 'Great website but Is there a way to get a certificate?',
            'created_at' => Carbon::now(),
        ]);
    }
}
