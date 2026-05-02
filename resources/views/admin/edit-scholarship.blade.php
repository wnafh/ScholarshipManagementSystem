<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">EDIT SCHOLARSHIP</h1>
        <p class="text-gray-600 mt-1">Requirements are pre-set and cannot be changed.</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.scholarships.update', $scholarship->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Scholarship Title</label>
                <input type="text" name="title" value="{{ $scholarship->title }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    <option value="Merit Based" {{ $scholarship->category == 'Merit Based' ? 'selected' : '' }}>Merit Based</option>
                    <option value="Need Based" {{ $scholarship->category == 'Need Based' ? 'selected' : '' }}>Need Based</option>
                    <option value="Sports" {{ $scholarship->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                    <option value="Research" {{ $scholarship->category == 'Research' ? 'selected' : '' }}>Research</option>
                    <option value="Arts" {{ $scholarship->category == 'Arts' ? 'selected' : '' }}>Arts</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                <input type="number" name="amount" value="{{ $scholarship->amount }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ $scholarship->start_date->format('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ $scholarship->end_date->format('Y-m-d') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>{{ $scholarship->description }}</textarea>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Required Documents (Pre-set)</label>
                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-4">
                    <li>Report Card / TOR</li>
                    <li>ALS Accreditation & Equivalency (if applicable)</li>
                    <li>Certificate of Residency (Original)</li>
                    <li>Certificate of Good Moral Character (Photocopy)</li>
                    <li>Certificate of Indigency or Eligibility (Original)</li>
                    <li>ITR of both parents or Certificate of Tax Exemption (Photocopy)</li>
                    <li>2x2 I.D. picture</li>
                </ul>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="draft" {{ $scholarship->status == 'draft' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500"> 
                        <span class="ml-2">Draft</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="published" {{ $scholarship->status == 'published' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500"> 
                        <span class="ml-2">Published</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="status" value="closed" {{ $scholarship->status == 'closed' ? 'checked' : '' }} class="text-teal-600 focus:ring-teal-500"> 
                        <span class="ml-2">Closed</span>
                    </label>
                </div>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Update Scholarship</button>
                <a href="{{ route('admin.scholarships.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>