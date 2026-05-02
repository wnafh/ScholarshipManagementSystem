<x-student-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">BROWSE SCHOLARSHIPS</h1>
        <p class="text-gray-600 mt-1">Browse and search for scholarships</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('student.scholarships.browse') }}" class="flex gap-4">
            <input type="text" name="search" placeholder="Search by Scholarship Name" value="{{ request('search') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
            <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Search</button>
            @if(request('search'))
                <a href="{{ route('student.scholarships.browse') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg transition">Clear</a>
            @endif
        </form>
    </div>
    
    <div class="grid grid-cols-1  gap-6">
        @foreach($scholarships as $scholarship)
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $scholarship->title }}</h3>
            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($scholarship->description, 100) }}</p>
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Deadline:</span>
                    <span class="font-medium">{{ $scholarship->end_date->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Amount:</span>
                    <span class="font-medium text-teal-600">{{ number_format($scholarship->amount, 2) }}</span>
                </div>
            </div>
            <a href="{{ route('student.scholarships.details', $scholarship->id) }}" class="block text-center bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition">VIEW DETAILS</a>
        </div>
        @endforeach
    </div>
</x-student-layout>