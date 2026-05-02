<x-reviewer-layout>
    <div class="mb-4">
        <a href="{{ route('reviewer.assigned.index') }}" class="text-teal-600 hover:text-teal-700 flex items-center gap-2">
            <span>←</span> Back to Assigned Applications
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Evaluate Application</h1>
        <p class="text-gray-600 mb-6">Application ID: APP{{ str_pad($application->id, 3, '0', STR_PAD_LEFT) }}</p>
        
        <!-- Student Information -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-md font-semibold text-gray-800 mb-3">Student Information</h2>
            <div class="space-y-1">
                <p><span class="font-medium">Name:</span> {{ $application->student->full_name ?? 'N/A' }}</p>
                <p><span class="font-medium">Email:</span> {{ $application->student->email ?? 'N/A' }}</p>
                <p><span class="font-medium">Education Level:</span> {{ $application->student->education_level ?? 'N/A' }}</p>
                <p><span class="font-medium">Scholarship:</span> {{ $application->scholarship->title ?? 'N/A' }}</p>
            </div>
        </div>
        
        <!-- Personal Statement -->
        @if($application->personal_statement)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-md font-semibold text-gray-800 mb-3">Personal Statement</h2>
            <p class="text-gray-700">{{ $application->personal_statement }}</p>
        </div>
        @endif
        
        <!-- Submitted Documents -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-md font-semibold text-gray-800 mb-3">Submitted Documents</h2>
            <div class="space-y-2">
                @if($application->transcript_path)
                    <div class="flex justify-between items-center">
                        <span>📄 Report Card / Transcript</span>
                        <a href="{{ Storage::url($application->transcript_path) }}" target="_blank" class="text-teal-600 hover:underline">View Document</a>
                    </div>
                @endif
                @if($application->recommendation_letter_path)
                    <div class="flex justify-between items-center">
                        <span>📄 Recommendation Letter / Good Moral</span>
                        <a href="{{ Storage::url($application->recommendation_letter_path) }}" target="_blank" class="text-teal-600 hover:underline">View Document</a>
                    </div>
                @endif
            </div>
        </div>
        
        <form method="POST" action="{{ route('reviewer.evaluation.store', $application->id) }}" class="space-y-6">
            @csrf
            
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-4">SCORING & EVALUATION</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Academic Performance (40%)</label>
                        <input type="number" name="academic_score" step="0.01" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Enter score (0-100)" value="{{ old('academic_score', $application->academic_score) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Personal Statement (30%)</label>
                        <input type="number" name="personal_statement_score" step="0.01" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Enter score (0-100)" value="{{ old('personal_statement_score', $application->personal_statement_score) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Extracurricular (20%)</label>
                        <input type="number" name="extracurricular_score" step="0.01" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Enter score (0-100)" value="{{ old('extracurricular_score', $application->extracurricular_score) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Recommendations (10%)</label>
                        <input type="number" name="recommendations_score" step="0.01" min="0" max="100" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Enter score (0-100)" value="{{ old('recommendations_score', $application->recommendations_score) }}" required>
                    </div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">COMMENTS & FEEDBACK</label>
                <textarea name="feedback" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Provide your feedback and comments about this application...">{{ old('feedback', $application->feedback) }}</textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">RECOMMENDATION</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="recommendation" value="approve" class="text-teal-600 focus:ring-teal-500" {{ old('recommendation', $application->recommendation) == 'approve' ? 'checked' : '' }} required>
                        <span class="ml-2">Approve</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="recommendation" value="reject" class="text-teal-600 focus:ring-teal-500" {{ old('recommendation', $application->recommendation) == 'reject' ? 'checked' : '' }}>
                        <span class="ml-2">Reject</span>
                    </label>
                </div>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Continue to Finalize</button>
                <a href="{{ route('reviewer.assigned.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</x-reviewer-layout>