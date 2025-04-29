<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examIds = DB::table('exams')->pluck('id')->toArray();

        foreach ($examIds as $examId) {
            $this->seedQuestionsForExam($examId);
        }
    }

    private function seedQuestionsForExam(int $examId): void
    {
        $exam = DB::table('exams')->where('id', $examId)->first();

        switch ($exam->name) {
            case 'Exam 1':
                $this->seedMathQuestions($examId);
                break;
            case 'Exam 2':
                $this->seedScienceQuestions($examId);
                break;
            case 'Exam 3':
                $this->seedHistoryQuestions($examId);
                break;
            case 'Exam 4':
                $this->seedGeneralKnowledgeQuestions($examId);
                break;
            default:
                $this->seedDefaultQuestions($examId);
        }
    }

    private function seedMathQuestions(int $examId): void
    {
        $questions = [
            [
                'question' => 'What is the result of 25 × 4?',
                'answers' => [
                    ['text' => '100', 'is_correct' => true],
                    ['text' => '90', 'is_correct' => false],
                    ['text' => '125', 'is_correct' => false],
                    ['text' => '75', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all prime numbers from the list:',
                'answers' => [
                    ['text' => '2', 'is_correct' => true],
                    ['text' => '3', 'is_correct' => true],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                    ['text' => '6', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'What is the area of a rectangle with length 8 and width 6?',
                'answers' => [
                    ['text' => '48 square units', 'is_correct' => true],
                    ['text' => '28 square units', 'is_correct' => false],
                    ['text' => '14 square units', 'is_correct' => false],
                    ['text' => '56 square units', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all even numbers:',
                'answers' => [
                    ['text' => '2', 'is_correct' => true],
                    ['text' => '4', 'is_correct' => true],
                    ['text' => '5', 'is_correct' => false],
                    ['text' => '6', 'is_correct' => true],
                    ['text' => '9', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'What is 30% of 200?',
                'answers' => [
                    ['text' => '60', 'is_correct' => true],
                    ['text' => '40', 'is_correct' => false],
                    ['text' => '70', 'is_correct' => false],
                    ['text' => '50', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
        ];

        $this->insertQuestions($examId, $questions);
    }

    private function seedScienceQuestions(int $examId): void
    {
        $questions = [
            [
                'question' => 'What is the chemical symbol for gold?',
                'answers' => [
                    ['text' => 'Au', 'is_correct' => true],
                    ['text' => 'Ag', 'is_correct' => false],
                    ['text' => 'Fe', 'is_correct' => false],
                    ['text' => 'Cu', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all noble gases:',
                'answers' => [
                    ['text' => 'Helium', 'is_correct' => true],
                    ['text' => 'Neon', 'is_correct' => true],
                    ['text' => 'Oxygen', 'is_correct' => false],
                    ['text' => 'Argon', 'is_correct' => true],
                    ['text' => 'Nitrogen', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'What is the process by which plants make their own food?',
                'answers' => [
                    ['text' => 'Photosynthesis', 'is_correct' => true],
                    ['text' => 'Respiration', 'is_correct' => false],
                    ['text' => 'Fermentation', 'is_correct' => false],
                    ['text' => 'Digestion', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all parts of the human digestive system:',
                'answers' => [
                    ['text' => 'Esophagus', 'is_correct' => true],
                    ['text' => 'Lungs', 'is_correct' => false],
                    ['text' => 'Stomach', 'is_correct' => true],
                    ['text' => 'Small intestine', 'is_correct' => true],
                    ['text' => 'Kidney', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'What is the largest organ in the human body?',
                'answers' => [
                    ['text' => 'Skin', 'is_correct' => true],
                    ['text' => 'Liver', 'is_correct' => false],
                    ['text' => 'Heart', 'is_correct' => false],
                    ['text' => 'Brain', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
        ];

        $this->insertQuestions($examId, $questions);
    }

    private function seedHistoryQuestions(int $examId): void
    {
        $questions = [
            [
                'question' => 'Who was the first President of the United States?',
                'answers' => [
                    ['text' => 'George Washington', 'is_correct' => true],
                    ['text' => 'Thomas Jefferson', 'is_correct' => false],
                    ['text' => 'Abraham Lincoln', 'is_correct' => false],
                    ['text' => 'John Adams', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Which countries were part of the Allied Powers in World War II?',
                'answers' => [
                    ['text' => 'United States', 'is_correct' => true],
                    ['text' => 'Great Britain', 'is_correct' => true],
                    ['text' => 'Soviet Union', 'is_correct' => true],
                    ['text' => 'Japan', 'is_correct' => false],
                    ['text' => 'Germany', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'Who wrote the Declaration of Independence?',
                'answers' => [
                    ['text' => 'Thomas Jefferson', 'is_correct' => true],
                    ['text' => 'George Washington', 'is_correct' => false],
                    ['text' => 'Benjamin Franklin', 'is_correct' => false],
                    ['text' => 'John Adams', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all ancient civilizations that built pyramids:',
                'answers' => [
                    ['text' => 'Egyptians', 'is_correct' => true],
                    ['text' => 'Maya', 'is_correct' => true],
                    ['text' => 'Greeks', 'is_correct' => false],
                    ['text' => 'Aztecs', 'is_correct' => true],
                    ['text' => 'Romans', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'The Renaissance period originated in which country?',
                'answers' => [
                    ['text' => 'Italy', 'is_correct' => true],
                    ['text' => 'France', 'is_correct' => false],
                    ['text' => 'England', 'is_correct' => false],
                    ['text' => 'Spain', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
        ];

        $this->insertQuestions($examId, $questions);
    }

    private function seedGeneralKnowledgeQuestions(int $examId): void
    {
        $questions = [
            [
                'question' => 'What is the capital of Australia?',
                'answers' => [
                    ['text' => 'Canberra', 'is_correct' => true],
                    ['text' => 'Sydney', 'is_correct' => false],
                    ['text' => 'Melbourne', 'is_correct' => false],
                    ['text' => 'Perth', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all countries that are part of Scandinavia:',
                'answers' => [
                    ['text' => 'Norway', 'is_correct' => true],
                    ['text' => 'Sweden', 'is_correct' => true],
                    ['text' => 'Denmark', 'is_correct' => true],
                    ['text' => 'Finland', 'is_correct' => false],
                    ['text' => 'Iceland', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'Who painted the Mona Lisa?',
                'answers' => [
                    ['text' => 'Leonardo da Vinci', 'is_correct' => true],
                    ['text' => 'Pablo Picasso', 'is_correct' => false],
                    ['text' => 'Vincent van Gogh', 'is_correct' => false],
                    ['text' => 'Michelangelo', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Select all of the following that are mammals:',
                'answers' => [
                    ['text' => 'Whale', 'is_correct' => true],
                    ['text' => 'Dolphin', 'is_correct' => true],
                    ['text' => 'Shark', 'is_correct' => false],
                    ['text' => 'Bat', 'is_correct' => true],
                    ['text' => 'Lizard', 'is_correct' => false],
                    'question_type' => 'multiple'
                ]
            ],
            [
                'question' => 'Which planet in our solar system has the most moons?',
                'answers' => [
                    ['text' => 'Saturn', 'is_correct' => true],
                    ['text' => 'Jupiter', 'is_correct' => false],
                    ['text' => 'Uranus', 'is_correct' => false],
                    ['text' => 'Neptune', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
        ];

        $this->insertQuestions($examId, $questions);
    }

    private function seedDefaultQuestions(int $examId): void
    {
        $questions = [
            [
                'question' => 'What is the value of π (pi) to two decimal places?',
                'answers' => [
                    ['text' => '3.14', 'is_correct' => true],
                    ['text' => '3.15', 'is_correct' => false],
                    ['text' => '3.16', 'is_correct' => false],
                    ['text' => '3.17', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'Which programming language was created by James Gosling at Sun Microsystems?',
                'answers' => [
                    ['text' => 'Java', 'is_correct' => true],
                    ['text' => 'Python', 'is_correct' => false],
                    ['text' => 'C++', 'is_correct' => false],
                    ['text' => 'JavaScript', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
            [
                'question' => 'What does HTML stand for?',
                'answers' => [
                    ['text' => 'Hypertext Markup Language', 'is_correct' => true],
                    ['text' => 'Hyper Transfer Markup Language', 'is_correct' => false],
                    ['text' => 'Hypertext Management Language', 'is_correct' => false],
                    ['text' => 'Hyper Technical Meta Language', 'is_correct' => false],
                    'question_type' => 'single'
                ]
            ],
        ];

        $this->insertQuestions($examId, $questions);
    }

    private function insertQuestions(int $examId, array $questions): void
    {
        foreach ($questions as $questionData) {
            $data = [
                'exam_id' => $examId,
                'questions' => $questionData['question'],
                'answers' => json_encode($questionData['answers']),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('questions')->insert($data);
        }
    }
}
