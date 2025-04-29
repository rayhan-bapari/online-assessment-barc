<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $exam->name }} - Question {{ $currentIndex + 1 }}/{{ $totalQuestions }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Timer -->
                <div class="p-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <span class="font-bold">Time Remaining:</span>
                        <span id="timer" class="ml-2 text-xl font-mono"></span>
                    </div>
                    <div>
                        <span class="font-bold">Progress:</span>
                        <span class="ml-2">{{ $currentIndex + 1 }} of {{ $totalQuestions }}</span>
                    </div>
                </div>

                <!-- Question -->
                <div class="p-6">
                    <div class="mb-8 p-4 border rounded-lg">
                        <h3 class="text-lg font-semibold mb-3">{{ $question->questions }}</h3>

                        @if (!$answeredQuestion)
                            <form method="POST" action="{{ route('exams.answer', $exam->id) }}" id="questionForm">
                                @csrf

                                <div class="ml-4 mt-2">
                                    @if ($question->isMultipleChoice())
                                        <p class="text-sm text-gray-500 mb-2">Select all that apply</p>
                                        @foreach ($question->getAnswerOptions() as $key => $option)
                                            <div class="mb-2">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="answer[]" value="{{ $key }}"
                                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <span class="ml-2">{{ $option['text'] }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 mb-2">Select one answer</p>
                                        @foreach ($question->getAnswerOptions() as $key => $option)
                                            <div class="mb-2">
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}"
                                                        required
                                                        class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                    <span class="ml-2">{{ $option['text'] }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="mt-6 flex justify-center">
                                    <button type="submit"
                                        class="px-6 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Submit Answer
                                    </button>
                                </div>
                            </form>
                        @else
                            <!-- Answer Feedback -->
                            <div class="mt-4 p-4 rounded-lg {{ $lastAnswer ? 'bg-green-50' : 'bg-red-50' }}">
                                <div class="flex items-start">
                                    @if ($lastAnswer)
                                        <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <h4 class="font-medium text-green-800">Correct!</h4>
                                            <p class="text-green-700 mt-1">Great job, you got this right.</p>
                                        </div>
                                    @else
                                        <svg class="w-6 h-6 text-red-600 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <div>
                                            <h4 class="font-medium text-red-800">Incorrect</h4>
                                            <p class="text-red-700 mt-1">Here's the correct answer:</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4 ml-8">
                                    <h5 class="font-medium text-gray-700 mb-2">Correct Answer(s):</h5>
                                    <ul class="list-disc list-inside">
                                        @foreach ($question->getCorrectAnswers() as $option)
                                            <li class="text-gray-700">{{ $option['text'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-center">
                                <form method="POST" action="{{ route('exams.next', $exam->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="px-6 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Next Question
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const remainingSeconds = Math.floor({{ $remainingSeconds }});
            let timeLeft = remainingSeconds;

            const timerElement = document.getElementById('timer');

            updateTimerDisplay();

            const timerInterval = setInterval(function() {
                timeLeft--;

                updateTimerDisplay();

                if (timeLeft < 60) {
                    timerElement.classList.add('text-red-600');
                    timerElement.classList.add('font-bold');
                } else if (timeLeft < 300) {
                    timerElement.classList.add('text-yellow-600');
                }

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    window.location.href = "{{ route('exams.complete', $exam->id) }}";
                }
            }, 1000);

            function updateTimerDisplay() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;

                timerElement.textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            window.addEventListener('beforeunload', function(e) {
                if (document.getElementById('questionForm')) {
                    e.preventDefault();
                    e.returnValue = 'You have an ongoing exam. Are you sure you want to leave?';
                }
            });
        });
    </script>
</x-app-layout>
