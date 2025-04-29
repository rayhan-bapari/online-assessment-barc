<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $exam->name }} - Results
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    @if($timeUp)
                        <div class="mb-6 p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="font-semibold">Time's up! The exam was automatically submitted.</p>
                            </div>
                        </div>
                    @endif

                    <div class="text-center">
                        <h3 class="text-2xl font-bold mb-6">Your Score: {{ $score }}%</h3>

                        <div class="inline-block rounded-full overflow-hidden p-1 border-4 {{ $passed ? 'border-green-500' : 'border-red-500' }} mb-4">
                            <div class="bg-{{ $passed ? 'green' : 'red' }}-100 rounded-full px-8 py-2">
                                <span class="text-xl font-bold text-{{ $passed ? 'green' : 'red' }}-700">
                                    {{ $passed ? 'PASSED' : 'FAILED' }}
                                </span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-center">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <p class="text-sm text-blue-600">Total Questions</p>
                                <p class="text-2xl font-bold">{{ $totalQuestions }}</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <p class="text-sm text-green-600">Correct Answers</p>
                                <p class="text-2xl font-bold">{{ $correctAnswers }}</p>
                            </div>
                            <div class="bg-red-50 p-4 rounded-lg">
                                <p class="text-sm text-red-600">Wrong Answers</p>
                                <p class="text-2xl font-bold">{{ $totalQuestions - $correctAnswers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Detailed Results</h3>

                    @foreach($results as $questionId => $result)
                        <div class="mb-8 p-4 rounded-lg {{ $result['correct'] ? 'bg-green-50' : 'bg-red-50' }}">
                            <div class="flex items-start justify-between">
                                <h4 class="text-lg font-medium mb-2">
                                    {{ $result['question']->questions }}
                                </h4>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $result['correct'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $result['correct'] ? 'Correct' : 'Incorrect' }}
                                </span>
                            </div>

                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">{{ $result['question']->isMultipleChoice() ? 'Multiple correct answers' : 'Single correct answer' }}</p>

                                <div class="ml-4 space-y-2">
                                    @foreach($result['question']->getAnswerOptions() as $key => $option)
                                        <div class="flex items-center">
                                            @php
                                                $isSelected = in_array($key, $result['selected']);
                                                $isCorrect = isset($option['is_correct']) && $option['is_correct'] === true;
                                            @endphp

                                            @if($isSelected && $isCorrect)
                                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif($isSelected && !$isCorrect)
                                                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif(!$isSelected && $isCorrect)
                                                <svg class="w-5 h-5 text-yellow-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif

                                            <span class="{{ $isCorrect ? 'font-medium' : '' }} {{ $isSelected ? ($isCorrect ? 'text-green-700' : 'text-red-700') : '' }}">
                                                {{ $option['text'] }}
                                                @if($isCorrect)
                                                    <span class="text-xs font-normal text-green-600">(Correct answer)</span>
                                                @endif
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('exams') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Return to All Exams
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
