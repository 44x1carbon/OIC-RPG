<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(TestDataSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ProductionTypeSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(JobSeeder::class);
    }
}
