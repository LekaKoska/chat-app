<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->ownerOfPosts->name }}'s Post</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

<div class="max-w-2xl mx-auto px-4 space-y-6">


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


    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 space-y-5">


        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
            Comments ({{ $post->comments_count ?? 0 }})
        </h3>


        <div class="flex items-start gap-3">

            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                <img
                    src="{{ auth()->user()->avatar
                                ? asset('storage/images/avatars/' . auth()->user()->avatar)
                                : asset('default-avatar.png') }}"
                    alt="Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <form class="flex-1">
                @csrf
                <textarea
                    name="comment"
                    rows="2"
                    class="w-full p-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Write a comment..."
                ></textarea>

                <div class="text-right mt-2">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-4 mt-6">

            @forelse($post->comments ?? [] as $comment)
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                        <img
                            src="{{ $comment->user->avatar
                                        ? asset('storage/images/avatars/' . $comment->user->avatar)
                                        : asset('default-avatar.png') }}"
                            alt="Avatar"
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <div class="flex-1 bg-gray-50 dark:bg-gray-900 rounded-xl p-3">
                        <div class="flex items-center justify-between">
                            <h4 class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                                {{ $comment->user->name }}
                            </h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="mt-1 text-gray-800 dark:text-gray-200 text-sm">
                            {{ $comment->content }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">No comments yet.</p>
            @endforelse
        </div>

    </div>

</div>

</body>
</html>
