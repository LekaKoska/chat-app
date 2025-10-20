<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Posts</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

<div class="max-w-2xl mx-auto px-4 space-y-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Community Feed</h1>
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

                <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                    <img
                        src="{{ $post->ownerOfPosts->avatar
                                    ? asset('storage/images/avatars/' . $post->ownerOfPosts->avatar)
                                    : asset('default-avatar.png') }}"
                        alt="Avatar"
                        class="w-full h-full object-cover"
                    >
                </div>


                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h2 class="font-semibold text-gray-900 dark:text-gray-100">
                            {{ $post->ownerOfPosts->name }}
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
        {{ $posts->links('pagination::tailwind') }}
    </div>
@endif

</body>
</html>
