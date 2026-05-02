<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Scholara') }} - Reviewer Portal</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-teal-800 text-white flex-shrink-0 fixed h-full overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-center mb-8">
                    <x-application-logo class="block h-10 w-auto fill-current text-white" />
                </div>
                
                <div class="text-center mb-6 pb-4 border-b border-teal-700">
                    <p class="text-sm text-teal-300">Welcome,</p>
                    <p class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                </div>
                
                <nav class="space-y-2">
                    <a href="{{ route('reviewer.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('reviewer.dashboard') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📊</span>
                        DASHBOARD
                    </a>
                    
                    <a href="{{ route('reviewer.assigned.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('reviewer.assigned.*') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">📋</span>
                        MY ASSIGNED APPLICATIONS
                    </a>
                    
                    <a href="{{ route('reviewer.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-teal-700 transition {{ request()->routeIs('reviewer.profile') ? 'bg-teal-700' : '' }}">
                        <span class="text-xl">👤</span>
                        MY PROFILE
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
        
        <main class="flex-1 ml-64 overflow-y-auto">
            <div class="py-6 px-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">{{ session('error') }}</div>
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