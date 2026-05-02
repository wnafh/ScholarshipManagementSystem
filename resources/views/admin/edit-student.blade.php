<x-admin-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">EDIT STUDENT</h1>
        <p class="text-gray-600 mt-1">Editing: {{ $student->full_name }}</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.students.update', $student->id) }}" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                    <input type="text" name="first_name" value="{{ $student->first_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $student->middle_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                    <input type="text" name="last_name" value="{{ $student->last_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $student->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Educational Level</label>
                <select name="education_level" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    <option value="High School Student" {{ $student->education_level == 'High School Student' ? 'selected' : '' }}>High School Student</option>
                    <option value="Undergraduate Student" {{ $student->education_level == 'Undergraduate Student' ? 'selected' : '' }}>Undergraduate Student</option>
                    <option value="Graduate Student" {{ $student->education_level == 'Graduate Student' ? 'selected' : '' }}>Graduate Student</option>
                    <option value="PhD Student" {{ $student->education_level == 'PhD Student' ? 'selected' : '' }}>PhD Student</option>
                </select>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Update</button>
                <a href="{{ route('admin.students.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layout>