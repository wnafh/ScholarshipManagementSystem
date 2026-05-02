<x-student-layout>
    <div class="mb-4">
        <a href="{{ route('student.scholarships.browse') }}" class="text-teal-600 hover:text-teal-700 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Browse Scholarships
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $scholarship->title }}</h1>
        
        <div class="grid grid-cols-2 gap-4 mb-6 pb-4 border-b">
            <div>
                <p class="text-gray-500 text-sm">Amount</p>
                <p class="text-2xl font-bold text-teal-600">{{ number_format($scholarship->amount, 2) }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Deadline</p>
                <p class="text-lg font-semibold">{{ $scholarship->end_date->format('F d, Y') }}</p>
            </div>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
            <p class="text-gray-600">{{ $scholarship->description }}</p>
        </div>
        
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Required Documents</h3>
            <ul class="list-disc list-inside space-y-1 text-gray-700 ml-4">
                <li>Report Card / TOR</li>
                <li>ALS Accreditation & Equivalency (if applicable)</li>
                <li>Certificate of Residency (Original)</li>
                <li>Certificate of Good Moral Character (Photocopy)</li>
                <li>Certificate of Indigency or Eligibility (Original)</li>
                <li>ITR of both parents or Certificate of Tax Exemption (Photocopy)</li>
                <li>2x2 I.D. picture</li>
            </ul>
        </div>
        
        @if($scholarship->requirements && $scholarship->requirements != json_encode($scholarship::getDefaultRequirements()))
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Additional Requirements</h3>
            @php
                $requirements = is_string($scholarship->requirements) ? json_decode($scholarship->requirements, true) : $scholarship->requirements;
            @endphp
            @if($requirements && is_array($requirements))
                <ul class="list-disc list-inside text-gray-600 ml-4">
                    @foreach($requirements as $req)
                        <li>{{ $req }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        @endif
        
        <a href="{{ route('student.applications.create', $scholarship->id) }}" class="inline-block bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg transition font-semibold">
            APPLY NOW
        </a>
    </div>
</x-student-layout>