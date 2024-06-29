<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = [
            [
                'title' => 'MS OFFICE',
                'description' => 'Learn essential skills for using Microsoft Office applications such as Word, Excel, and PowerPoint.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'GRAPHIC DESIGNING',
                'description' => 'Master the principles and tools of graphic design, including Adobe Photoshop and Illustrator.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VIDEO EDITING',
                'description' => 'Develop proficiency in video editing techniques using software like Adobe Premiere Pro and Final Cut Pro.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'WEB DEVELOPMENT',
                'description' => 'Gain expertise in web development technologies like HTML, CSS, JavaScript, and frameworks such as React and Vue.js.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'DROPSHIPPING',
                'description' => 'Explore the fundamentals of dropshipping business models, including product sourcing, marketing strategies, and logistics.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Course::insert($courses);

    }
}
