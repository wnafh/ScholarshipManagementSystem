<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">APPROVE REVIEWERS</h1>
    </div>
    
    <div class="space-y-6">
        @forelse($pendingReviewers as $reviewer)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Applicant: {{ $reviewer->full_name }}</h2>
                    <p class="text-gray-600">Email: {{ $reviewer->email }}</p>
                    <p class="text-gray-600">Occupation: {{ $reviewer->occupation ?? 'N/A' }}</p>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('admin.reviewers.approve-store', $reviewer->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">Approve</button>
                    </form>
                    <form action="{{ route('admin.reviewers.reject', $reviewer->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">Reject</button>
                    </form>
                </div>
            </div>
            
            <div class="border-t pt-4">
                <h3 class="font-semibold text-gray-700 mb-2">Documents:</h3>
                <div class="flex gap-3">
                    @if($reviewer->resume_path)
                        <a href="{{ Storage::url($reviewer->resume_path) }}" class="text-teal-600 hover:text-teal-700" target="_blank">📄 View Resume/CV</a>
                    @endif
                    @if($reviewer->proof_of_expertise_path)
                        <a href="{{ Storage::url($reviewer->proof_of_expertise_path) }}" class="text-teal-600 hover:text-teal-700" target="_blank">📜 View Proof of Expertise</a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow p-6 text-center">
            <p class="text-gray-600">No pending reviewers to approve.</p>
        </div>
        @endforelse
    </div>
</x-admin-layout>