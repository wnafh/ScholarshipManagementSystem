<x-student-layout>
    <div class="mb-4">
        <a href="{{ route('student.applications.index') }}" class="text-teal-600 hover:text-teal-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            BACK TO MY APPLICATIONS
        </a>
    </div>
    
    <div class="grid lg:grid-cols-3 ">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-4">APPLICATION DETAILS</h1>
                <div class="space-y-2">
                    <p><span class="font-semibold">Application ID:</span> APP{{ str_pad($application->id, 3, '0', STR_PAD_LEFT) }}</p>
                    <p><span class="font-semibold">Scholarship:</span> {{ $application->scholarship->title ?? 'N/A' }}</p>
                    <p><span class="font-semibold">Applied:</span> {{ $application->applied_date->format('F d, Y') }}</p>
                    <p><span class="font-semibold">Status:</span>
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($application->status == 'pending') bg-yellow-100 text-yellow-800 
                            @elseif($application->status == 'assigned') bg-blue-100 text-blue-800 
                            @elseif($application->status == 'reviewed') bg-purple-100 text-purple-800 
                            @elseif($application->status == 'approved') bg-green-100 text-green-800 
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($application->status) }}
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">APPLICATION TIMELINE</h2>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Application Submitted</p>
                            <p class="text-sm text-gray-500">{{ $application->applied_date->format('M d, Y') }}</p>
                        </div>
                    </div>
                    
                    @if(in_array($application->status, ['assigned', 'reviewed', 'approved', 'rejected']))
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Application Assigned to Reviewer</p>
                            <p class="text-sm text-gray-500">{{ $application->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if(in_array($application->status, ['reviewed', 'approved', 'rejected']))
                    <div class="flex gap-3">
                        <div class="w-8 h-8 {{ $application->status == 'reviewed' ? 'bg-yellow-100' : 'bg-green-100' }} rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 {{ $application->status == 'reviewed' ? 'text-yellow-600' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Evaluation Completed</p>
                            <p class="text-sm text-gray-500">{{ $application->reviewed_date ? $application->reviewed_date->format('M d, Y') : 'In Progress' }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if($application->status == 'approved')
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Scholarship Awarded</p>
                            <p class="text-sm text-gray-500">{{ $application->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">YOUR SUBMISSION</h2>
                <div class="mb-4">
                    <p class="font-semibold mb-2">Personal Statement</p>
                    <p class="text-gray-600">{{ $application->personal_statement ?? 'No statement provided' }}</p>
                </div>
                <div>
                    <p class="font-semibold mb-2">Documents:</p>
                    <div class="space-y-2">
                        @if($application->transcript_path)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Official Transcript</span>
                                <a href="{{ Storage::url($application->transcript_path) }}" target="_blank" class="text-teal-600 hover:text-teal-700">View</a>
                            </div>
                        @endif
                        @if($application->recommendation_letter_path)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Recommendation Letter</span>
                                <a href="{{ Storage::url($application->recommendation_letter_path) }}" target="_blank" class="text-teal-600 hover:text-teal-700">View</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</x-student-layout>