<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('exams', [ExamController::class, 'index'])->name('exams');
    Route::get('exams/{id}', [ExamController::class, 'show'])->name('exams.show');

    Route::get('exams/{id}/start', [ExamController::class, 'start'])->name('exams.start');
    Route::get('exams/{id}/question', [ExamController::class, 'showQuestion'])->name('exams.question');
    Route::post('exams/{id}/answer', [ExamController::class, 'answerQuestion'])->name('exams.answer');
    Route::post('exams/{id}/next', [ExamController::class, 'nextQuestion'])->name('exams.next');
    Route::get('exams/{id}/complete', [ExamController::class, 'completeExam'])->name('exams.complete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
