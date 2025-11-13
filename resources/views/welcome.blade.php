@php use Illuminate\Support\Facades\Auth; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @if(auth()->check())
        <script>window.auth = {user: {id: {{ auth()->id() }}, name: @json(auth()->user()->name) }};</script>
    @endif
    <style>
        /* Optional: smooth out the page width */
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
<header class="py-4 px-6 border-b border-gray-200 dark:border-gray-800">
    <div class="container flex items-center justify-between">
        <a href="/" class="text-xl font-semibold text-gray-900 dark:text-white">MyChatApp</a>
        <nav class="flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}"
                   class="text-sm text-gray-700 dark:text-gray-300 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:underline">Register</a>
            @else
                <a href="{{ route('dashboard') }}" class="text-sm text-indigo-600 hover:underline">Dashboard</a>
            @endguest
        </nav>
    </div>
</header>

<main class="py-12 px-4 sm:px-6 lg:px-16">
    <section class="container">
        <div class="mb-10">
            <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">MyChatApp</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                Place where you can make new friends, chat in real-time, participate in discussions, vote for your
                favourite posts, and follow your friends' activity.
            </p>
        </div>

        @guest
            <div class="mt-6 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('register') }}"
                   class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition text-center">
                    Register
                </a>
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center">
                    Login
                </a>
            </div>
        @endguest

        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 mb-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 8h10M7 12h8m-6 8l-5-5H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-5 5z"/>
                </svg>
                <h3 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Messages</h3>
                <p class="text-gray-600 dark:text-gray-300">Chat with your friends in real-time.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.29-.9L3 20l1.1-4.71A8.963 8.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <h3 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Discussions</h3>
                <p class="text-gray-600 dark:text-gray-300">Create topics, participate in conversations, and share
                    opinions.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500 mb-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <h3 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Votes</h3>
                <p class="text-gray-600 dark:text-gray-300">Vote for your favourite discussion and posts.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow hover:shadow-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-500 mb-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zM2 20a6 6 0 0112 0H2zM14 14h8"/>
                </svg>
                <h3 class="text-2xl font-semibold mb-2 text-gray-900 dark:text-white">Friends</h3>
                <p class="text-gray-600 dark:text-gray-300">Add new friends and follow their activity.</p>
            </div>
        </div>

        <div class="mt-16">
            <p class="text-gray-600 dark:text-gray-400 mb-4">Are you ready to start new friendships and explore the
                app?</p>
            <a href="{{ Auth::user() ? route('posts.index') : route('register') }}"
               class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">Start now</a>
        </div>
    </section>
</main>
</body>
</html>
