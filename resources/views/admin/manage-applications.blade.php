<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">MANAGE APPLICATIONS</h1>
        <p class="text-gray-600 mt-1">Review, assign, and approve/reject applications</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.applications.index') }}" class="flex gap-4 flex-wrap">
            <input type="text" name="search" placeholder="Search by Student Name or Scholarship" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition">Filter</button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.applications.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition">Clear</a>
            @endif
        </form>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">App ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applied Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reviewer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($applications as $app)
                    <tr class="border-t">
                        <td class="px-6 py-4">APP{{ str_pad($app->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $app->student->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->applied_date->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($app->reviewer)
                                {{ $app->reviewer->full_name }}
                            @else
                                <span class="text-red-500">Not Assigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($app->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($app->status == 'assigned') bg-blue-100 text-blue-800
                                @elseif($app->status == 'reviewed') bg-purple-100 text-purple-800
                                @elseif($app->status == 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($app->status == 'pending')
                                <a href="{{ route('admin.applications.assign', $app->id) }}" class="text-teal-600 hover:text-teal-900">Assign</a>
                            
                            @elseif($app->status == 'reviewed')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.applications.approve', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs" onclick="return confirm('Approve this application?')">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.applications.reject', $app->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs" onclick="return confirm('Reject this application?')">
                                            Reject
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.applications.show', $app->id) }}" class="text-teal-600 hover:text-teal-900">View</a>
                                </div>
                            
                            @elseif($app->status == 'assigned')
                                <span class="text-gray-400">Waiting for Review</span>
                            
                            @else
                                <a href="{{ route('admin.applications.show', $app->id) }}" class="text-teal-600 hover:text-teal-900">View</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No applications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>