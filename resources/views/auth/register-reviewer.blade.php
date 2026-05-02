<x-guest-layout>
    <div class="max-w-lg mx-auto">
        <div class="bg-white p-8 rounded-lg shadow">
            <div class="text-center mb-6">
                <div class="flex justify-center mb-3">
                    <x-application-logo class="block h-14 w-auto fill-current text-gray-800" />
                </div>
                <h2 class="text-2xl font-bold">Scholara</h2>
                <p class="text-gray-600">Reviewer Sign Up</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="role" value="reviewer">
                
                <!-- Name Fields Row -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                        <input type="text" name="first_name" placeholder="First Name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name</label>
                        <input type="text" name="middle_name" placeholder="Middle Name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                        <input type="text" name="last_name" placeholder="Last Name" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                    </div>
                </div>
                
                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" placeholder="Email" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                
                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" placeholder="Password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                
                <!-- Confirm Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                
                <!-- Occupation Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Occupation</label>
                    <input type="text" name="occupation" placeholder="Occupation" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                
                <!-- CV Upload Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload CV/Resume</label>
                    <input type="file" name="resume_path" class="w-full text-sm text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-lg file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept=".pdf,.doc,.docx" required>
                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, or DOCX (Max 5MB)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload proof of expertise (diploma/reference)</label>
                    <input type="file" name="proof_of_expertise_path" class="w-full text-sm text-gray-500 file:mr-2 file:py-2 file:px-4 file:rounded-lg file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept=".pdf,.jpg,.png" required>
                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, or PNG (Max 5MB)</p>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold transition mt-6">
                    SUBMIT FOR REVIEW
                </button>
                
                <!-- Back Link -->
                <div class="text-center mt-4">
                    <a href="{{ route('choose.acc') }}" class="text-teal-600 hover:text-teal-700 text-sm">← Back to role selection</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>