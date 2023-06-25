<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Question;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = app(Generator::class);

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

        $courses = Course::get();

        foreach($courses as $course){
            for ($i = 0; $i < 30; $i++) {
                Question::create([
                    'course_id'         => $course->id,
                    'question'          => 'This is Sample Question No. '.$i. ' of '.$course->name.'.',
                    'option_1'          => 'Option 1',
                    'option_2'          => 'Option 2',
                    'option_3'          => 'Option 3',
                    'option_4'          => 'Option 4',
                    'correct_option'    => $faker->randomElement([1, 2, 3, 4]),
                    'status'            => true,
                ]);
            }
        }
    }
}
