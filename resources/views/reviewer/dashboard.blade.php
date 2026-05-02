<x-reviewer-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">REVIEWER DASHBOARD</h1>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Assigned</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalAssigned }}</p>
                </div>
                
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Reviews</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingReviews }}</p>
                </div>
                
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Completed Reviews</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $completedReviews }}</p>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Recently Assigned Applications</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentApplications as $app)
                    <tr class="border-t">
                        <td class="px-6 py-4">APP{{ str_pad($app->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $app->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->student->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $app->status == 'reviewed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $app->status == 'reviewed' ? 'Completed' : 'Pending Review' }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-reviewer-layout>