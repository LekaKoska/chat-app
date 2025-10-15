<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Post</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-xl bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
    <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-full overflow-hidden">
                <img
                    src="{{ auth()->user()->avatar ? asset('storage/images/avatars/' . auth()->user()->avatar) : asset('default-avatar.png') }}"
                    alt="Avatar"
                    class="w-full h-full object-cover"
                >
            </div>
            <textarea
                name="content"
                placeholder="What's on your mind?"
                class="flex-1 p-3 rounded-xl border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 resize-none"
                rows="4"
            ></textarea>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-full font-medium hover:bg-indigo-700 transition-all duration-200"
            >
                Post
            </button>
        </div>
    </form>
</div>

</body>
</html>

</html>
