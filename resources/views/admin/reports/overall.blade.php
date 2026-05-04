<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Overall Report</h1>
        <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Print Report</button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 text-teal-600">System Statistics</h3>
            <div class="space-y-3">
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600">Total Students:</span>
                    <span class="font-bold text-gray-800">{{ $totalStudents }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600">Total Reviewers:</span>
                    <span class="font-bold text-gray-800">{{ $totalReviewers }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600">Total Scholarships:</span>
                    <span class="font-bold text-gray-800">{{ $totalScholarships }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600">Total Applications:</span>
                    <span class="font-bold text-gray-800">{{ $totalApplications }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-600">Approved Applications:</span>
                    <span class="font-bold text-green-600">{{ $approvedApplications }}</span>
                </div>
                <div class="flex justify-between pt-2">
                    <span class="text-gray-600 font-semibold">Total Funding Amount:</span>
                    <span class="font-bold text-teal-600 text-lg">{{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>
        </div>
        
        
    </div>
</x-admin-layout>