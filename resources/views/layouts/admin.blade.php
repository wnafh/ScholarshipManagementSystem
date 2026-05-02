<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Scholara') }} - Admin Panel</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-teal-800 text-white flex-shrink-0 fixed h-full overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-center gap-2 mb-8">
                    <x-application-logo class="block h-8 w-auto fill-current text-white" />
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.dashboard') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📊</span>
                        DASHBOARD
                    </a>
                    
                    <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.applications.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📋</span>
                        MANAGE APPLICATIONS
                    </a>
                    
                    <a href="{{ route('admin.scholarships.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.scholarships.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">🎓</span>
                        MANAGE SCHOLARSHIP
                    </a>
                    
                    <a href="{{ route('admin.students.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.students.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">👨‍🎓</span>
                        MANAGE STUDENT
                    </a>
                    
                    <a href="{{ route('admin.reviewers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.reviewers.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📝</span>
                        MANAGE REVIEWER
                    </a>
                    
                    <a href="{{ route('admin.reviewers.approve') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.reviewers.approve') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">✅</span>
                        APPROVE REVIEWERS
                    </a>
                    
                    <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('admin.reports.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📈</span>
                        GENERATE REPORT
                    </a>
                </nav>
            </div>
            
            <div class="absolute bottom-0 left-0 w-64 p-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 text-white/70 hover:text-white transition w-full">
                        <span class="text-xl">🚪</span>
                        Log out
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 ml-64 overflow-y-auto">
            <div class="py-6 px-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>