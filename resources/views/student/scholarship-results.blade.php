<x-student-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">SCHOLARSHIP RESULTS</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Scholarship</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Review Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Result</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Feedback / Letter</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($results as $result)
                    <tr class="border-t">
                        <td class="px-6 py-4">APP{{ str_pad($result->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $result->scholarship->title ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $result->reviewed_date ? $result->reviewed_date->format('M d, Y') : 'Pending' }}</td>
                        <td class="px-6 py-4">
                            @if($result->status == 'approved')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">APPROVED</span>
                            @elseif($result->status == 'rejected')
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">REJECTED</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">PENDING</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($result->status == 'approved')
                                <a href="#" class="text-teal-600 hover:text-teal-900 text-sm">Download Award Letter</a>
                            @elseif($result->status == 'rejected' && $result->feedback)
                                <span class="text-sm text-gray-600">{{ Str::limit($result->feedback, 60) }}</span>
                            @elseif($result->status == 'rejected')
                                <span class="text-sm text-gray-400">No feedback provided</span>
                            @else
                                <span class="text-sm text-gray-400">Waiting for review</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-student-layout>