<x-reviewer-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">ASSIGNED APPLICATIONS</h1>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('reviewer.assigned.index') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Search by Applicant Name" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Search</button>
            @if(request('search'))
                <a href="{{ route('reviewer.assigned.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition">Clear</a>
            @endif
        </form>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Applicant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Assigned Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($applications as $app)
                    <tr class="border-t">
                        <td class="px-6 py-4">APP{{ str_pad($app->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $app->student->full_name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $app->status == 'reviewed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $app->status == 'reviewed' ? 'Completed' : 'Pending Review' }}
                            </span>
                        <td>
                        <td class="px-6 py-4">
                            <a href="{{ route('reviewer.assigned.show', $app->id) }}" class="text-teal-600 hover:text-teal-900 mr-3">View</a>
                            @if($app->status != 'reviewed')
                                <a href="{{ route('reviewer.evaluation.evaluate', $app->id) }}" class="text-blue-600 hover:text-blue-900">Evaluate</a>
                            @else
                                <span class="text-gray-400">Evaluated</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-reviewer-layout>