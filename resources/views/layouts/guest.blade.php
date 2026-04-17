<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ChatApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
<!-- Background Decoration -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-100 dark:bg-indigo-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 dark:opacity-10 animate-pulse"></div>
    <div class="absolute -bottom-8 right-1/4 w-96 h-96 bg-blue-100 dark:bg-blue-900 rounded-full mix-blend-multiply filter blur-3xl opacity-20 dark:opacity-10 animate-pulse" style="animation-delay: 2s;"></div>
</div>

<div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="flex items-center justify-center mb-4">
            <div class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                💬 ChatApp
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="w-full sm:max-w-md">
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-2xl border border-white/20 dark:border-gray-700/20">
            <div class="px-6 sm:px-8 py-8 sm:py-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
        <p>{{ config('app.name', 'ChatApp') }} © {{ date('Y') }}</p>
    </div>
</div>
</body>
</html>
