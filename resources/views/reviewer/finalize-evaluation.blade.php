<x-reviewer-layout>
    <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Finalize Evaluation</h1>
        <p class="text-gray-600 mb-6">{{ auth()->user()->first_name ?? 'Reviewer' }} {{ auth()->user()->last_name ?? '' }} - Scholarship Reviewer</p>
        
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">REVIEW SUMMARY</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <p><span class="font-semibold">Student:</span> {{ $application->student->full_name ?? 'N/A' }}</p>
                <p><span class="font-semibold">Scholarship:</span> {{ $application->scholarship->title ?? 'N/A' }}</p>
                <p><span class="font-semibold">Application ID:</span> APP{{ str_pad($application->id, 3, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-3">SCORES:</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span>Academic Performance (40%):</span>
                    <span>{{ $application->academic_score }}/100 ({{ number_format($application->academic_score * 0.4, 2) }}/40)</span>
                </div>
                <div class="flex justify-between">
                    <span>Personal Statement (30%):</span>
                    <span>{{ $application->personal_statement_score }}/100 ({{ number_format($application->personal_statement_score * 0.3, 2) }}/30)</span>
                </div>
                <div class="flex justify-between">
                    <span>Extracurricular (20%):</span>
                    <span>{{ $application->extracurricular_score }}/100 ({{ number_format($application->extracurricular_score * 0.2, 2) }}/20)</span>
                </div>
                <div class="flex justify-between">
                    <span>Recommendations (10%):</span>
                    <span>{{ $application->recommendations_score }}/100 ({{ number_format($application->recommendations_score * 0.1, 2) }}/10)</span>
                </div>
                <div class="flex justify-between pt-2 border-t font-bold">
                    <span>TOTAL SCORE:</span>
                    <span class="text-teal-600">{{ number_format($application->score, 2) }}/100</span>
                </div>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="font-semibold text-gray-800 mb-2">RECOMMENDATION: <span class="text-teal-600">{{ strtoupper($application->recommendation) }}</span></h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="font-semibold mb-1">Comments:</p>
                <p>{{ $application->feedback }}</p>
            </div>
        </div>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <p class="text-yellow-700">Please confirm your review before submitting. This action cannot be undone.</p>
        </div>
        
        <div class="flex gap-4">
            <a href="{{ route('reviewer.evaluation.confirm', $application->id) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Confirm Submit</a>
            <a href="{{ route('reviewer.assigned.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Back</a>
        </div>
    </div>
</x-reviewer-layout>