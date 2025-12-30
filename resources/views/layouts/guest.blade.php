<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .shadow-soft {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            border-color: #667eea;
        }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased">
    <!-- Background with gradient and pattern -->
    <div class="min-h-screen bg-gradient relative overflow-hidden">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <!-- Logo/Brand Section -->
            <div class="mb-8 text-center">
                <a href="/" class="inline-block">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">{{ config('app.name', 'Laravel') }}</span>
                    </div>
                </a>
                <p class="mt-3 text-white/80 text-sm">Welcome back! Please sign in to your account.</p>
            </div>

            <!-- Main Card -->
            <div class="glass-effect w-full max-w-md rounded-2xl shadow-soft overflow-hidden transition-all duration-300 hover:shadow-xl">
                <div class="px-8 py-8 sm:p-10">
                    {{ $slot }}
                </div>
                
                <!-- Footer Links -->
                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                    <div class="text-center text-sm text-gray-600">
                        © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                </div>
            </div>

            <!-- Additional Links -->
            <div class="mt-6 text-center">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#" class="text-sm text-white/70 hover:text-white transition">Privacy Policy</a>
                    <span class="text-white/30">•</span>
                    <a href="#" class="text-sm text-white/70 hover:text-white transition">Terms of Service</a>
                    <span class="text-white/30">•</span>
                    <a href="{{ route('register') }}" class="text-sm text-white/70 hover:text-white transition">Create Account</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Animation styles -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>