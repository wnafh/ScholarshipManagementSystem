<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">Reviewers Report</h1>
        <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Print Report</button>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Occupation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reviews Done</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($reviewers as $reviewer)
                    <tr class="border-t">
                        <td class="px-6 py-4">{{ $reviewer->full_name }}</td>
                        <td class="px-6 py-4">{{ $reviewer->email }}</td>
                        <td class="px-6 py-4">{{ $reviewer->occupation ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $reviewer->reviewerAssignments->count() }}</td>
                        <td class="px-6 py-4">{{ ucfirst($reviewer->reviewerProfile->status ?? 'Pending') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>