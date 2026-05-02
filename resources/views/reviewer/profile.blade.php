{{-- resources/views/reviewer/profile.blade.php --}}
<x-reviewer-layout>
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Profile Settings</h1>
        <p class="text-gray-600 mt-1">Manage your personal information, professional credentials, and account security.</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">General Information</h2>
                <p class="text-sm text-gray-500 mb-4">Details used for scholarship evaluation reports and internal correspondence.</p>
                <form method="POST" action="{{ route('reviewer.profile.update') }}" class="space-y-4">@csrf @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                    </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                    <input type="text" name="position" value="{{ $user->occupation ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="e.g., Senior Faculty Reviewer">
                </div>
                <p class="text-xs text-gray-500 mt-4">Only authorized administrators can change your Reviewer profile.</p>
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">Update Profile</button>
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition">Cancel</button>
                </div>
            </form>
        </div></div>
        
    </div>
</x-reviewer-layout>