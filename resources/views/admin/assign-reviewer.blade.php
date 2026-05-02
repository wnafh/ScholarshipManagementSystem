<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">ASSIGN REVIEWER TO APPLICATION</h1>
        <p class="text-gray-600 mt-1">Application ID: APP{{ str_pad($application->id, 3, '0', STR_PAD_LEFT) }}</p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Application Details -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Application Details</h2>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Student Name:</span>
                    <span class="text-gray-800">{{ $application->student->full_name ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Student Email:</span>
                    <span class="text-gray-800">{{ $application->student->email ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Scholarship:</span>
                    <span class="text-gray-800">{{ $application->scholarship->title ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Category:</span>
                    <span class="text-gray-800">{{ $application->scholarship->category ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Applied Date:</span>
                    <span class="text-gray-800">{{ $application->applied_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-600">Current Status:</span>
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($application->status) }}</span>
                </div>
            </div>
        </div>
        
        <!-- Assign Reviewer Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Reviewer</h2>
            
            @if(isset($reviewers) && $reviewers->count() > 0)
                <form method="POST" action="{{ route('admin.applications.assign-reviewer', $application->id) }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Choose a Reviewer</label>
                        <select name="reviewer_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                            <option value="">-- Select Reviewer --</option>
                            @foreach($reviewers as $reviewer)
                                <option value="{{ $reviewer->id }}">
                                    {{ $reviewer->full_name }} - {{ $reviewer->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <p class="text-sm text-yellow-700">Only approved reviewers are shown here. Make sure the reviewer has expertise in {{ $application->scholarship->category ?? 'this field' }}.</p>
                    </div>
                    
                    <div class="flex gap-4">
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Assign Reviewer</button>
                        <a href="{{ route('admin.applications.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</a>
                    </div>
                </form>
            @else
                <div class="bg-red-50 border-l-4 border-red-500 p-4">
                    <p class="text-red-700">No approved reviewers available.</p>
                    <p class="text-sm text-red-600 mt-1">Please approve reviewers first from the "Approve Reviewers" section.</p>
                    <a href="{{ route('admin.reviewers.approve') }}" class="inline-block mt-3 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition text-sm">Go to Approve Reviewers</a>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>