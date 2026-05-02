<x-student-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">MY APPLICATIONS</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($applications as $app)
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
                        <td class="px-6 py-4">
                            <a href="{{ route('student.applications.show', $app->id) }}" class="text-teal-600 hover:text-teal-900">VIEW DETAILS</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-student-layout>