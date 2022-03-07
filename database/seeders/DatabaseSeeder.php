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
                        TrainerSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            Course_ContentSeeder::class,

            contactUsSeeder::class,  
          questionSeeder::class,

            ExamSeeder::class,
            feedbackSeeder::class,
                      UserSeeder::class,

        ]);
    }
}
