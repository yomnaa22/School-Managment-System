<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            contactUsSeeder::class,
            Course_ContentSeeder::class,
            CourseSeeder::class,
            ExamSeeder::class,
            feedbackSeeder::class,
            questionSeeder::class,
            StudentSeeder::class,
            TrainerSeeder::class,
            UserSeeder::class,
           
        ]);
    }
}
