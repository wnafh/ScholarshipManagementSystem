<x-student-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">STUDENT DASHBOARD</h1>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalApplications }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pending Applications</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $pendingApplications }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Awarded Scholarships</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $awardedApplications }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Recent Applications</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentApplications as $app)
                    <tr>
                        <td class="px-6 py-4">APP{{ str_pad($app->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $app->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->applied_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($app->status == 'pending') bg-yellow-100 text-yellow-800 
                                @elseif($app->status == 'assigned') bg-blue-100 text-blue-800 
                                @elseif($app->status == 'reviewed') bg-purple-100 text-purple-800 
                                @elseif($app->status == 'approved') bg-green-100 text-green-800 
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-student-layout>