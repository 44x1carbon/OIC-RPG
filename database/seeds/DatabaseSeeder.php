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
        $this->call(ProductionTypeSeeder::class);
        $this->call(FieldSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(CourseSeeder::class);
        if(env('APP_ENV') == 'local') {
            $this->call(GuildMemberSeeder::class);
            $this->call(PartySeeder::class);
        }
    }
}
