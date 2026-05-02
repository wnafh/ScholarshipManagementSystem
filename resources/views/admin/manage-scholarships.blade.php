<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800">MANAGE SCHOLARSHIP</h1>
        <a href="{{ route('admin.scholarships.create') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">
            + CREATE NEW SCHOLARSHIP
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.scholarships.index') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Search by Scholarship Name" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg transition">Search</button>
            @if(request('search'))
                <a href="{{ route('admin.scholarships.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition">Clear</a>
            @endif
        </form>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($scholarships as $scholarship)
                    <tr>
                        <td class="px-6 py-4">{{ $scholarship->title }}</td>
                        <td class="px-6 py-4">{{ number_format($scholarship->amount, 2) }}</td>
                        <td class="px-6 py-4">{{ $scholarship->end_date->format('Y-m-d') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                @if($scholarship->status == 'published') bg-green-100 text-green-800
                                @elseif($scholarship->status == 'draft') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($scholarship->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.scholarships.edit', $scholarship->id) }}" class="text-teal-600 hover:text-teal-900 mr-3">Edit</a>
                            <form action="{{ route('admin.scholarships.destroy', $scholarship->id) }}" method="POST" class="inline">
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