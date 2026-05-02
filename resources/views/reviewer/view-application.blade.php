<x-reviewer-layout>
    <div class="mb-4">
        <a href="{{ route('reviewer.assigned.index') }}" class="text-teal-600 hover:text-teal-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Assigned Applications
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">STUDENT INFORMATION</h1>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Name</p>
                        <p class="font-semibold">{{ $application->student->full_name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Email</p>
                        <p class="font-semibold">{{ $application->student->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Education</p>
                        <p class="font-semibold">{{ $application->student->education_level ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Scholarship</p>
                        <p class="font-semibold">{{ $application->scholarship->title ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Status</p>
                        <p class="font-semibold">{{ ucfirst($application->status) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Statement</h2>
                <p class="text-gray-600">{{ $application->personal_statement ?? 'No personal statement provided.' }}</p>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Submitted Documents</h2>
                <div class="space-y-2">
                    @if($application->transcript_path)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <span>📄 Official Transcript</span>
                            <a href="{{ Storage::url($application->transcript_path) }}" target="_blank" class="text-teal-600 hover:text-teal-700">View PDF</a>
                        </div>
                    @endif
                    @if($application->recommendation_letter_path)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <span>📄 Recommendation Letter</span>
                            <a href="{{ Storage::url($application->recommendation_letter_path) }}" target="_blank" class="text-teal-600 hover:text-teal-700">View PDF</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold text-gray-800 mb-3">Quick Actions</h3>
                @if($application->status != 'reviewed')
                    <a href="{{ route('reviewer.evaluation.evaluate', $application->id) }}" class="block w-full text-center bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition mb-2">Start Evaluation</a>
                @endif
                <button onclick="window.print()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">Print Application</button>
            </div>
            
            @if($application->status == 'reviewed')
            <div class="bg-white rounded-lg shadow p-6 mt-4">
                <h3 class="font-semibold text-gray-800 mb-3">Evaluation Summary</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span>Academic Score:</span>
                        <span class="font-medium">{{ $application->academic_score ?? 'N/A' }}/100</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Personal Statement:</span>
                        <span class="font-medium">{{ $application->personal_statement_score ?? 'N/A' }}/100</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Extracurricular:</span>
                        <span class="font-medium">{{ $application->extracurricular_score ?? 'N/A' }}/100</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Recommendations:</span>
                        <span class="font-medium">{{ $application->recommendations_score ?? 'N/A' }}/100</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t font-bold">
                        <span>Total Score:</span>
                        <span class="text-teal-600">{{ $application->score ?? 'N/A' }}/100</span>
                    </div>
                    <div class="pt-2">
                        <span class="font-semibold">Recommendation:</span>
                        <span class="ml-2">{{ ucfirst($application->recommendation ?? 'N/A') }}</span>
                    </div>
                    @if($application->feedback)
                    <div class="pt-2">
                        <span class="font-semibold">Feedback:</span>
                        <p class="text-gray-600 mt-1">{{ $application->feedback }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</x-reviewer-layout>