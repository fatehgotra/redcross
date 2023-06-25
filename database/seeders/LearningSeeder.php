<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'Course A',
        ]);

        Course::create([
            'name' => 'Course B',
        ]);

        Course::create([
            'name' => 'Course C',
        ]);

        Course::create([
            'name' => 'Course D',
        ]);

        Course::create([
            'name' => 'Course E',
        ]);

        Course::create([
            'name' => 'Course F',
        ]);

        Course::create([
            'name' => 'Course G',
        ]);

        Course::create([
            'name' => 'Course H',
        ]);

        Course::create([
            'name' => 'Course I',
        ]);
    }
}
