<x-student-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">APPLY FOR SCHOLARSHIP</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6 max-w-3xl mx-auto">
        <div class="mb-6">
            <p class="text-gray-600">Applicant: <span class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></p>
            <p class="text-gray-600">Scholarship: <span class="font-semibold">{{ $scholarship->title }}</span> - {{ number_format($scholarship->amount, 2) }}</p>
            <p class="text-gray-600">Deadline: <span class="font-semibold text-red-600">{{ $scholarship->end_date->format('F d, Y') }}</span></p>
        </div>
        
        <form method="POST" action="{{ route('student.applications.store', $scholarship->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">PERSONAL STATEMENT</label>
                <textarea name="personal_statement" rows="8" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" placeholder="Tell us about your academic achievements, goals, and why you deserve this scholarship. (Minimum 300 words)" required></textarea>
                <p class="text-xs text-gray-500 mt-1">Minimum 300 words</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">REQUIRED DOCUMENTS</label>
                
                <!-- Display Requirements List -->
                @php
                    $requirements = $scholarship->getFormattedRequirementsAttribute();
                @endphp
                
                <div class="bg-gray-50 rounded-lg p-3 mb-4">
                    <p class="text-sm text-gray-600">Required documents for this scholarship:</p>
                    <ul class="list-disc list-inside text-sm text-gray-600 ml-2">
                        @foreach($requirements as $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </ul>
                </div>
                
                <!-- Transcript Upload -->
                <div class="border rounded-lg p-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Report Card / TOR / Transcript</label>
                    <input type="file" name="transcript" class="w-full text-sm text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-lg file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept=".pdf,.jpg,.jpeg,.png" required>
                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, or PNG. Max 5MB</p>
                </div>
                
                <!-- Recommendation Letter Upload -->
                <div class="border rounded-lg p-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Recommendation Letter / Good Moral Character</label>
                    <input type="file" name="recommendation_letter" class="w-full text-sm text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-lg file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept=".pdf,.jpg,.jpeg,.png" required>
                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, or PNG. Max 5MB</p>
                </div>
                
                <!-- Supporting Documents (Residency, Indigency, ITR, ID Picture, etc.) -->
                <div class="border rounded-lg p-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Other Supporting Documents</label>
                    <p class="text-xs text-gray-500 mb-2">Certificate of Residency, Certificate of Indigency, ITR, 2x2 ID Picture, ALS Certificate (if applicable)</p>
                    <input type="file" name="supporting_documents[]" class="w-full text-sm text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-lg file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept=".pdf,.jpg,.jpeg,.png" multiple>
                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, or PNG. Max 5MB each. You can upload multiple files.</p>
                </div>
            </div>
            
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-sm text-yellow-700">Please ensure all documents are clear and readable. Incomplete applications may not be processed.</p>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition font-semibold">SUBMIT APPLICATION</button>
                <a href="{{ route('student.scholarships.browse') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</x-student-layout>