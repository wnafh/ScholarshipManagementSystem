<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">MANAGE REVIEWER</h1>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.reviewers.index') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Search Reviewer Name" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.reviewers.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition">Clear</a>
            @endif
        </form>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Occupation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($reviewers as $reviewer)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $reviewer->full_name }}</td>
                        <td class="px-6 py-4">{{ $reviewer->email }}</td>
                        <td class="px-6 py-4">{{ $reviewer->occupation ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @php
                                $categories = [];
                                if ($reviewer->reviewerProfile && $reviewer->reviewerProfile->assigned_categories) {
                                    $assigned = $reviewer->reviewerProfile->assigned_categories;
                                    if (is_array($assigned)) {
                                        $categories = $assigned;
                                    } elseif (is_string($assigned)) {
                                        $categories = json_decode($assigned, true) ?: [$assigned];
                                    }
                                }
                            @endphp
                            {{ !empty($categories) ? implode(', ', $categories) : 'Unassigned' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($reviewer->reviewerProfile)
                                <span class="px-2 py-1 text-xs rounded-full 
                                    @if($reviewer->reviewerProfile->status == 'approved') bg-green-100 text-green-800
                                    @elseif($reviewer->reviewerProfile->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800
                                    @endif">
                                    {{ ucfirst($reviewer->reviewerProfile->status) }}
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.reviewers.edit', $reviewer->id) }}" class="text-teal-600 hover:text-teal-900 mr-3">Edit</a>
                            <form action="{{ route('admin.reviewers.destroy', $reviewer->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>