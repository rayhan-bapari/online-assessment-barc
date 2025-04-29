<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Exams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-200 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-6 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-700">Available Exams</h3>
            </div>

            @if ($examLists->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($examLists as $exam)
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition">
                            <div class="p-6 border-b border-gray-200">
                                <h4 class="text-xl font-bold mb-2">{{ $exam->name }}</h4>
                                <div class="flex justify-between text-sm text-gray-600 mb-4">
                                    <div>
                                        <i class="fas fa-clock mr-1"></i> {{ $exam->getReadableDuration() }}
                                    </div>
                                    <div>
                                        <i class="fas fa-check-circle mr-1"></i> Pass: {{ $exam->pass_mark }}%
                                    </div>
                                </div>

                                @php
                                    $attempt = auth()->user()->examAttempts()->where('exam_id', $exam->id)->first();
                                @endphp

                                @if ($attempt)
                                    <div class="border-t border-gray-100 pt-4 mt-4">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="text-gray-600 text-sm">Your score:</span>
                                                <span class="font-bold text-lg ml-2">{{ $attempt->score }}%</span>
                                            </div>
                                            <div>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $attempt->passed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $attempt->passed ? 'PASSED' : 'FAILED' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest">
                                            <i class="fas fa-check-circle mr-2"></i> Completed
                                        </span>
                                    </div>
                                @else
                                    <div class="mt-4 flex justify-end">
                                        <a href="{{ route('exams.start', $exam->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="fas fa-play-circle mr-2"></i> Start Exam
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <p class="mb-4">No exams available yet.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
