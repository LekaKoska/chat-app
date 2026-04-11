<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

<div class="max-w-2xl mx-auto px-4 space-y-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">
        Edit Your Post
    </h1>

    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 transition hover:shadow-md">
        <div class="flex items-start gap-4">

            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                <img
                    src="{{ auth()->user()->avatar
                                ? asset('storage/images/avatars/' . auth()->user()->avatar)
                                : asset('default-avatar.png') }}"
                    alt="Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="flex-1">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Edit content
                        </label>
                        <textarea
                            name="content"
                            id="content"
                            rows="5"
                            class="w-full p-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Update your post content..."
                        >{{ old('content', $post->content) }}</textarea>

                        @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('posts.show', $post->id) }}"
                           class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>
