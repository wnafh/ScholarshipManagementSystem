<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">VIEW APPLICATION</h1>
        <p class="text-gray-600 mt-1">Application ID: APP{{ str_pad($application->id, 3, '0', STR_PAD_LEFT) }}</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Student Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Student Information</h2>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Full Name:</span>
                    <span class="text-gray-800">{{ $application->student->full_name ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Email:</span>
                    <span class="text-gray-800">{{ $application->student->email ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Education Level:</span>
                    <span class="text-gray-800">{{ $application->student->education_level ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Applied Date:</span>
                    <span class="text-gray-800">{{ $application->applied_date->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Scholarship Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Scholarship Information</h2>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Title:</span>
                    <span class="text-gray-800">{{ $application->scholarship->title ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Category:</span>
                    <span class="text-gray-800">{{ $application->scholarship->category ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Amount:</span>
                    <span class="text-gray-800">{{ number_format($application->scholarship->amount ?? 0, 2) }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Deadline:</span>
                    <span class="text-gray-800">{{ $application->scholarship->end_date ? $application->scholarship->end_date->format('M d, Y') : 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Personal Statement -->
    @if($application->personal_statement)
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Statement</h2>
        <p class="text-gray-700">{{ $application->personal_statement }}</p>
    </div>
    @endif
    
    <!-- Submitted Documents -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Submitted Documents</h2>
        <div class="space-y-3">
            @if($application->transcript_path)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <span>📄 Transcript / Report Card</span>
                    <a href="{{ Storage::url($application->transcript_path) }}" target="_blank" class="text-teal-600 hover:underline">View Document</a>
                </div>
            @endif
            @if($application->recommendation_letter_path)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <span>📄 Recommendation Letter</span>
                    <a href="{{ Storage::url($application->recommendation_letter_path) }}" target="_blank" class="text-teal-600 hover:underline">View Document</a>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Reviewer Evaluation -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Reviewer Evaluation</h2>
        
        @if($application->reviewer)
        <div class="mb-4 p-3 bg-blue-50 rounded">
            <p><span class="font-medium">Reviewed by:</span> {{ $application->reviewer->full_name }}</p>
            <p><span class="font-medium">Review Date:</span> {{ $application->reviewed_date ? $application->reviewed_date->format('M d, Y') : 'N/A' }}</p>
        </div>
        @endif
        
        <div class="grid grid-cols-2 gap-4">
            <div class="space-y-2">
                <div class="flex justify-between border-b pb-2">
                    <span>Academic Performance (40%):</span>
                    <span class="font-medium">{{ $application->academic_score ?? 'N/A' }}/100</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span>Personal Statement (30%):</span>
                    <span class="font-medium">{{ $application->personal_statement_score ?? 'N/A' }}/100</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span>Extracurricular (20%):</span>
                    <span class="font-medium">{{ $application->extracurricular_score ?? 'N/A' }}/100</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span>Recommendations (10%):</span>
                    <span class="font-medium">{{ $application->recommendations_score ?? 'N/A' }}/100</span>
                </div>
                <div class="flex justify-between pt-2 font-bold">
                    <span>TOTAL SCORE:</span>
                    <span class="text-teal-600">{{ $application->score ?? 'N/A' }}/100</span>
                </div>
            </div>
            <div class="space-y-2">
                <div class="p-3 rounded">
                    <span class="font-medium">Recommendation:</span>
                    <span class="ml-2 px-2 py-1 text-xs rounded-full 
                        @if($application->recommendation == 'approve') bg-green-100 text-green-800
                        @elseif($application->recommendation == 'reject') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ ucfirst($application->recommendation ?? 'N/A') }}
                    </span>
                </div>
                @if($application->feedback)
                <div class="mt-3 p-3 bg-gray-50 rounded">
                    <span class="font-medium">Feedback:</span>
                    <p class="text-gray-600 mt-1">{{ $application->feedback }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Status and Actions -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center">
            <div>
                <span class="font-medium">Current Status:</span>
                <span class="ml-2 px-2 py-1 text-xs rounded-full 
                    @if($application->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($application->status == 'assigned') bg-blue-100 text-blue-800
                    @elseif($application->status == 'reviewed') bg-purple-100 text-purple-800
                    @elseif($application->status == 'approved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($application->status) }}
                </span>
            </div>
            <div class="flex gap-3">
                @if($application->status == 'reviewed')
                    <a href="{{ route('admin.applications.index') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">Back to Applications</a>
                @endif
                @if($application->status == 'pending')
                    <a href="{{ route('admin.applications.assign', $application->id) }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">Assign Reviewer</a>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>