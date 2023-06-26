<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Question;
use App\Models\Video;
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

        foreach($courses as $course){
           

                Video::create([
                    'course_id'         => $course->id,
                    'url'               => 'https://www.youtube.com/embed/K04lI4VzMqE',
                    'title'             => 'Sample Video No.1 '.$course->name.'.',
                    'description'       => 'This field is to write Description for Video No.1 of '.$course->name.'.',                    
                    'status'            => true,
                ]);

                Video::create([
                    'course_id'         => $course->id,
                    'url'               => 'https://www.youtube.com/embed/AFf22L5ZZN4',
                    'title'             => 'Sample Video No.2 '.$course->name.'.',
                    'description'       => 'This field is to write Description for Video No.2 of '.$course->name.'.',                    
                    'status'            => true,
                ]);

                Video::create([
                    'course_id'         => $course->id,
                    'url'               => 'https://www.youtube.com/embed/kMk1qmaafWs',
                    'title'             => 'Sample Video No.3 '.$course->name.'.',
                    'description'       => 'This field is to write Description for Video No.3 of '.$course->name.'.',                    
                    'status'            => true,
                ]);

                Video::create([
                    'course_id'         => $course->id,
                    'url'               => 'https://www.youtube.com/embed/KU8kkvcZttU',
                    'title'             => 'Sample Video No.4 '.$course->name.'.',
                    'description'       => 'This field is to write Description for Video No.4 of '.$course->name.'.',                    
                    'status'            => true,
                ]);

                Video::create([
                    'course_id'         => $course->id,
                    'url'               => 'https://www.youtube.com/embed/7Gq2Rk8eVCY',
                    'title'             => 'Sample Video No.5 '.$course->name.'.',
                    'description'       => 'This field is to write Description for Video No.5 of '.$course->name.'.',                    
                    'status'            => true,
                ]);
            
        }
    }
}
