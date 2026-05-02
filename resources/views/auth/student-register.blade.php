<x-guest-layout>
    <div class="max-w-md mx-auto">
        <div class="bg-white p-8 rounded-lg shadow">
            <div class="text-center mb-6">
                <div class="flex justify-center mb-3">
                    <x-application-logo class="block h-14 w-auto fill-current text-gray-800" />
                </div>
                <h2 class="text-2xl font-bold">Scholara</h2>
                <p class="text-gray-600">Student Sign Up</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="role" value="student">
                
                <div class="grid grid-cols-3 gap-3">
                    <input type="text" name="first_name" placeholder="First Name" 
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                    <input type="text" name="middle_name" placeholder="Middle Name" 
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500">
                    <input type="text" name="last_name" placeholder="Last Name" 
                           class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                </div>
                
                <input type="email" name="email" placeholder="Email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                
                <input type="password" name="password" placeholder="Password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                
                <select name="education_level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500" required>
                    <option value="">Education level</option>
                    <option>High School</option>
                    <option>Undergraduate</option>
                    <option>Graduate</option>
                    <option>PhD</option>
                </select>
                
                <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2 rounded-lg font-semibold transition">
                    CREATE ACCOUNT
                </button>
                
                <div class="text-center">
                    <a href="{{ route('choose.acc') }}" class="text-teal-600 hover:text-teal-700 text-sm">← Back to role selection</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>