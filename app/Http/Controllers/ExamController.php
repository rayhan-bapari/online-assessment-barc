<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ExamController extends Controller
{
    public function index()
    {
        $examLists = Exam::all();
        $attemptedExams = auth()->user()->examAttempts()->pluck('exam_id')->toArray();

        return view("exams", compact("examLists", "attemptedExams"));
    }

    public function show($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return view('exams.show', compact('exam'));
    }

    public function start($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        $user = auth()->user();

        if ($user->hasAttemptedExam($id)) {
            return redirect()->route('exams')
                ->with('error', 'You have already taken this exam. You can only attempt an exam once.');
        }

        $endTime = now()->addMinutes($exam->exam_time);

        Session::put('exam_end_time', $endTime);
        Session::put('exam_id', $id);
        Session::put('current_question_index', 0);
        Session::put('correct_answers', 0);
        Session::put('answers', []);

        return redirect()->route('exams.question', $id);
    }

    public function showQuestion($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        $currentIndex = Session::get('current_question_index', 0);

        if ($currentIndex >= $exam->questions->count()) {
            return $this->completeExam($id);
        }

        $question = $exam->questions[$currentIndex];
        $totalQuestions = $exam->questions->count();
        $answeredQuestion = Session::get('last_answered_question') == $question->id;
        $lastAnswer = Session::get('last_answer_correct');

        $endTime = Session::get('exam_end_time');
        $remainingSeconds = now()->diffInSeconds($endTime, false);
        $remainingSeconds = max(0, $remainingSeconds);
        $remainingMinutes = ceil($remainingSeconds / 60);

        if ($remainingSeconds <= 0) {
            return $this->completeExam($id);
        }

        return view('exams.question', compact(
            'exam',
            'question',
            'currentIndex',
            'totalQuestions',
            'answeredQuestion',
            'lastAnswer',
            'remainingMinutes',
            'remainingSeconds'
        ));
    }

    public function answerQuestion(Request $request, $id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        $currentIndex = Session::get('current_question_index', 0);

        if ($currentIndex >= $exam->questions->count()) {
            return $this->completeExam($id);
        }

        $question = $exam->questions[$currentIndex];
        $selectedAnswers = $request->input('answer', []);

        if (!is_array($selectedAnswers)) {
            $selectedAnswers = [$selectedAnswers];
        }

        $isCorrect = $question->checkAnswer($selectedAnswers);

        $answers = Session::get('answers', []);
        $answers[$question->id] = [
            'selected' => $selectedAnswers,
            'correct' => $isCorrect
        ];
        Session::put('answers', $answers);

        if ($isCorrect) {
            Session::put('correct_answers', Session::get('correct_answers', 0) + 1);
        }

        Session::put('last_answered_question', $question->id);
        Session::put('last_answer_correct', $isCorrect);

        return redirect()->route('exams.question', $id);
    }

    public function nextQuestion($id)
    {
        $currentIndex = Session::get('current_question_index', 0);
        Session::put('current_question_index', $currentIndex + 1);
        Session::forget(['last_answered_question', 'last_answer_correct']);

        return redirect()->route('exams.question', $id);
    }

    public function completeExam($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        $answers = Session::get('answers', []);
        $correctAnswers = Session::get('correct_answers', 0);

        $totalQuestions = $exam->getTotalQuestions();
        $score = $exam->calculatePercentageScore($correctAnswers);
        $passed = $exam->isPassing($score);

        $endTime = Session::get('exam_end_time');
        $timeTaken = $exam->exam_time - ceil(max(0, now()->diffInSeconds($endTime, false)) / 60);
        $timeUp = $timeTaken >= $exam->exam_time;

        // Format results
        $results = [];
        foreach ($exam->questions as $question) {
            $questionId = $question->id;
            $answerData = $answers[$questionId] ?? null;

            $results[$questionId] = [
                'question' => $question,
                'selected' => $answerData ? $answerData['selected'] : [],
                'correct' => $answerData ? $answerData['correct'] : false,
            ];
        }

        $user = auth()->user();
        if (!$user->hasAttemptedExam($id)) {
            $user->examAttempts()->create([
                'exam_id' => $id,
                'score' => $score,
                'passed' => $passed,
                'time_taken' => $timeTaken,
                'completed_at' => now()
            ]);
        }

        Session::forget([
            'exam_end_time',
            'exam_id',
            'current_question_index',
            'correct_answers',
            'answers',
            'last_answered_question',
            'last_answer_correct'
        ]);

        return view('exams.results', compact(
            'exam',
            'results',
            'correctAnswers',
            'totalQuestions',
            'score',
            'passed',
            'timeUp'
        ));
    }

    public function submit(Request $request, $id)
    {
        $exam = Exam::with('questions')->findOrFail($id);

        $startTime = Session::get('exam_start_time');
        $timeElapsed = now()->diffInMinutes($startTime);
        $timeUp = $timeElapsed >= $exam->exam_time;

        $userAnswers = $request->input('answers', []);

        $correctAnswers = 0;
        $results = [];

        foreach ($exam->questions as $question) {
            $questionId = $question->id;
            $selectedAnswers = $userAnswers[$questionId] ?? [];

            if (!is_array($selectedAnswers)) {
                $selectedAnswers = [$selectedAnswers];
            }

            $isCorrect = $question->checkAnswer($selectedAnswers);

            if ($isCorrect) {
                $correctAnswers++;
            }

            $results[$questionId] = [
                'question' => $question,
                'selected' => $selectedAnswers,
                'correct' => $isCorrect,
            ];
        }

        $totalQuestions = $exam->getTotalQuestions();
        $score = $exam->calculatePercentageScore($correctAnswers);
        $passed = $exam->isPassing($score);

        Session::forget(['exam_start_time', 'exam_id']);

        return view('exams.results', compact(
            'exam',
            'results',
            'correctAnswers',
            'totalQuestions',
            'score',
            'passed',
            'timeUp'
        ));
    }
}
