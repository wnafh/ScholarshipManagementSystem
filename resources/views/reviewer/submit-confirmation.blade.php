<x-reviewer-layout>
    <div class="bg-white rounded-lg shadow p-8 max-w-md mx-auto text-center">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Review Submitted Successfully</h1>
        <p class="text-gray-600 mb-6">Thank you for completing the review for this application.</p>
        
        <a href="{{ route('reviewer.assigned.index') }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Return to Assigned Applications</a>
    </div>
</x-reviewer-layout>