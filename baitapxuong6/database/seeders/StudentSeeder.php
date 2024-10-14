<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Tạo 5 lớp học mẫu
        $classrooms = Classroom::factory()->count(5)->create();

        // Tạo 10 môn học mẫu
        $subjects = Subject::factory()->count(10)->create();

        // Tạo 50 sinh viên mẫu
        foreach ($classrooms as $classroom) {
            Student::factory()
                ->count(10)
                ->create(['classroom_id' => $classroom->id])
                ->each(function ($student) use ($subjects) {
                    // Gán các môn học cho sinh viên
                    $student->subjects()->attach(
                        $subjects->random(3)->pluck('id')->toArray() // Gán ngẫu nhiên 3 môn cho mỗi sinh viên
                    );
                });
        }
    }
}
