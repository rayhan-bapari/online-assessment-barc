<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = [
            ['name' => 'Exam 1', 'exam_time' => 6, 'pass_mark' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exam 2', 'exam_time' => 10, 'pass_mark' => 40, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exam 3', 'exam_time' => 15, 'pass_mark' => 35, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exam 4', 'exam_time' => 20, 'pass_mark' => 45, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($exams as $exam) {
            DB::table('exams')->insert($exam);
        }
    }
}
