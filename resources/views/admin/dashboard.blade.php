<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">ADMIN DASHBOARD</h1>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Students</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Reviews</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalReviews }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalApplications }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Applications -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Recent Applications</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applicant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentApplications as $app)
                    <tr>
                        <td class="px-6 py-4">{{ $app->student->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($app->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($app->status == 'assigned') bg-blue-100 text-blue-800
                                @elseif($app->status == 'reviewed') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-teal-600 hover:text-teal-900">
                                @if($app->status == 'pending') Assign @else View @endif
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pending Reviews -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Pending Reviews</h2>
        </div>
        <div class="p-6">
            <ul class="space-y-2">
                <li class="text-gray-600">{{ $pendingReviews }} applications waiting for assignment</li>
                <li class="text-gray-600">{{ $pendingReviewers }} reviewers pending approval</li>
            </ul>
        </div>
    </div>
</x-admin-layout>