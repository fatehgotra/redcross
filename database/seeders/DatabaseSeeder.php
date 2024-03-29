<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountriesSeeder::class);
        $this->call(WebsiteSeeder::class);
        $this->call(VolunteerSeeder::class);
        $this->call(LearningSeeder::class);
        $this->call(AlertSeeder::class);
    }
}
