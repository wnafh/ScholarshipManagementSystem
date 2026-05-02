<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Reports & Analytics</h1>
    </div>
    
    <div class="bg-white rounded-lg shadow p-8 max-w-2xl mx-auto">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Select Report Type</h2>
        
        <form method="POST" action="{{ route('admin.reports.generate') }}" class="space-y-4">
            @csrf
            
            <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                <input type="radio" name="report_type" value="students" class="text-teal-600 focus:ring-teal-500" required>
                <span class="ml-3 text-gray-700 font-medium">Students Report</span>
            </label>
            
            <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                <input type="radio" name="report_type" value="scholarships" class="text-teal-600 focus:ring-teal-500">
                <span class="ml-3 text-gray-700 font-medium">Scholarship Report</span>
            </label>
            
            <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                <input type="radio" name="report_type" value="reviewers" class="text-teal-600 focus:ring-teal-500">
                <span class="ml-3 text-gray-700 font-medium">Reviewers Report</span>
            </label>
            
            <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                <input type="radio" name="report_type" value="overall" class="text-teal-600 focus:ring-teal-500">
                <span class="ml-3 text-gray-700 font-medium">Overall Report</span>
            </label>
            
            <div class="mt-8 text-center">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-3 rounded-lg transition font-semibold">
                    Generate Report
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>