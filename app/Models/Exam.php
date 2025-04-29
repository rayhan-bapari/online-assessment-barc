<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'name',
        'exam_time',
        'pass_mark'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    public function singleChoiceQuestions()
    {
        return $this->questions()->whereJsonContains('answers->question_type', 'single');
    }

    public function multipleChoiceQuestions()
    {
        return $this->questions()->whereJsonContains('answers->question_type', 'multiple');
    }

    public function getDurationInMinutes(): int
    {
        return $this->exam_time;
    }

    public function getReadableDuration(): string
    {
        $minutes = $this->exam_time;

        if ($minutes < 60) {
            return "{$minutes} minutes";
        }

        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        if ($remainingMinutes === 0) {
            return "{$hours} hour" . ($hours > 1 ? 's' : '');
        }

        return "{$hours} hour" . ($hours > 1 ? 's' : '') . " and {$remainingMinutes} minute" . ($remainingMinutes > 1 ? 's' : '');
    }

    public function isPassing(int $score): bool
    {
        return $score >= $this->pass_mark;
    }

    public function getTotalQuestions(): int
    {
        return $this->questions()->count();
    }

    public function calculatePercentageScore(int $correctAnswers): float
    {
        $total = $this->getTotalQuestions();
        if ($total === 0) {
            return 0;
        }

        return round(($correctAnswers / $total) * 100, 2);
    }
}
