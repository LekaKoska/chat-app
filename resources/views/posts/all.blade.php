<x-app-layout>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>All Posts</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

    <div class="max-w-2xl mx-auto px-4 space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Community Feed</h1>
        <div class="mb-6">
            <form action="{{ route('posts.search') }}" method="GET" class="flex items-center gap-2">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search discussion..."
                       class="flex-1 px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    Search
                </button>
            </form>
        </div>

        <div x-data="{ open: false }" class="relative mb-6">
            <button @click="open = !open"
                    type="button"
                    class="w-40 flex justify-between items-center px-4 py-2 rounded-2xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none"
                    aria-haspopup="true" aria-expanded="open">
                Sort by
                <svg class="ml-2 h-5 w-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" x-cloak
                 class="absolute mt-2 w-40 rounded-2xl shadow-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 z-20">
                <a href="{{ route('posts.sort', array_merge(request()->query(), ['sort' => 'recent'])) }}"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl {{ request('sort') === 'recent' ? 'font-bold bg-gray-100 dark:bg-gray-700' : '' }}">
                    Recent
                </a>
                <a href="{{ route('posts.sort', array_merge(request()->query(), ['sort' => 'likes'])) }}"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl {{ request('sort') === 'likes' ? 'font-bold bg-gray-100 dark:bg-gray-700' : '' }}">
                    Most liked
                </a>
                <a href="{{ route('posts.sort', array_merge(request()->query(), ['sort' => 'comments'])) }}"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl {{ request('sort') === 'comments' ? 'font-bold bg-gray-100 dark:bg-gray-700' : '' }}">
                    Most commented
                </a>
            </div>
        </div>
        <div class="flex justify-end mb-6">
            <a href="{{ route('posts.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                Add New Post
            </a>
        </div>

        @forelse($posts as $post)
            <a href="{{ route('posts.show', $post->id) }}" class="block hover:shadow-lg transition rounded-2xl">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 transition hover:shadow-md">
                    <div class="flex items-start gap-4">
                        <div class="flex flex-col items-center w-12 text-center select-none">
                            <form method="POST" action="{{route('posts.upvote', $post->id)}}">
                                @csrf
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center rounded hover:bg-gray-200 transition-colors
                {{ auth()->user() && $post->votes()->where('user_id', auth()->id())->where('vote', 1)->exists() ? 'text-green-500 font-bold' : 'text-gray-500' }}">
                                    ▲
                                </button>
                            </form>

                            <div class="my-1 font-semibold text-gray-700">
                                {{ request('sort') === 'likes' ? ($post->votes_count ?? 0) : ($post->votes_count ?? 0) }}
                            </div>

                            <form method="POST" action="{{route('posts.downvote', $post->id)}}">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center rounded hover:bg-gray-200 transition-colors
                {{ auth()->user() && $post->votes()->where('user_id', auth()->id())->where('vote', -1)->exists() ? 'text-red-500 font-bold' : 'text-gray-500' }}">
                                    ▼
                                </button>
                            </form>
                        </div>

                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                            <img
                                src="{{ $post->ownerOfPost->avatar
                                    ? asset('storage/images/avatars/' . $post->ownerOfPost->avatar)
                                    : asset('default-avatar.png') }}"
                                alt="Avatar"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h2 class="font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $post->ownerOfPost->name }}
                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <p class="mt-2 text-gray-800 dark:text-gray-200 leading-relaxed">
                                {{ $post->content }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400">No posts yet.</p>
        @endforelse
    </div>

    @if ($posts->hasPages())
        <div class="pt-6">
            {{ $posts->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    @endif

    </body>
    </html>
</x-app-layout>
