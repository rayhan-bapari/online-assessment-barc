<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Question extends Model
{
    protected $fillable = [
        'exam_id',
        'questions',
        'answers'
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function isMultipleChoice()
    {
        return isset($this->answers['question_type']) && $this->answers['question_type'] === 'multiple';
    }

    public function getQuestionType()
    {
        return $this->answers['question_type'] ?? 'single';
    }

    public function getAnswerOptions(): array
    {
        $answers = $this->answers;

        if (isset($answers['question_type'])) {
            unset($answers['question_type']);
        }

        return $answers;
    }

    public function getCorrectAnswers(): array
    {
        $options = $this->getAnswerOptions();

        return array_filter($options, function ($option) {
            return $option['is_correct'] === true;
        });
    }

    public function checkAnswer(array $selectedAnswers): bool
    {
        $options = $this->getAnswerOptions();

        if (!is_array($selectedAnswers)) {
            $selectedAnswers = [$selectedAnswers];
        }

        $selectedAnswers = array_filter($selectedAnswers, function ($value) {
            return $value !== null && $value !== '';
        });


        if (!$this->isMultipleChoice()) {
            if (count($selectedAnswers) === 0) {
                return false;
            }

            $selectedKey = (string)$selectedAnswers[0];

            if (isset($options[$selectedKey]) && !empty($options[$selectedKey])) {
                return isset($options[$selectedKey]['is_correct']) && $options[$selectedKey]['is_correct'] === true;
            }

            return false;
        }

        $correctKeys = [];

        foreach ($options as $key => $option) {
            if (isset($option['is_correct']) && $option['is_correct'] === true) {
                $correctKeys[] = (string)$key;
            }
        }
        $selectedKeys = array_map('strval', $selectedAnswers);

        sort($correctKeys);
        sort($selectedKeys);
        return $correctKeys == $selectedKeys;
    }
}
