{{-- resources/views/public/choose-role.blade.php --}}
<x-guest-layout>
    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-8">
                <div class="flex justify-center mb-6">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-20 w-auto fill-current text-gray-800" />
                    </a>
                </div>
                
                <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">Choose Your Account Type</h1>
                <h3 class="text-lg font-semibold mb-8 text-center text-gray-600">Welcome to Scholara</h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Student Role -->
                    <a href="{{ route('register.student') }}" 
                       class="group block bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 rounded-lg p-6 transition-all duration-200 hover:scale-105">
                        <div class="text-center">
                            <div class="text-5xl mb-3">🎓</div>
                            <h3 class="text-2xl font-bold text-white mb-2">STUDENT</h3>
                            <p class="text-teal-100">Apply & track scholarships</p>
                        </div>
                    </a>

                    <!-- Reviewer Role -->
                    <a href="{{ route('register.reviewer') }}" 
                       class="group block bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 rounded-lg p-6 transition-all duration-200 hover:scale-105">
                        <div class="text-center">
                            <div class="text-5xl mb-3">📝</div>
                            <h3 class="text-2xl font-bold text-white mb-2">Reviewer</h3>
                            <div class="text-teal-100 space-y-1">
                                <p>• Review applications</p>
                                <p>• Score submissions</p>
                                <p>• Manage committees</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('login') }}" class="text-teal-600 hover:text-teal-700 font-medium">
                        Already have an account? Sign in →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>