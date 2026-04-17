<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Create a New Post</h1>
                <a href="{{ route('posts.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                    ← Back to Feed
                </a>
            </div>

            <form action="{{ route('posts.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
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
                        rows="6"
                        required
                    ></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('posts.index') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition"
                    >
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
