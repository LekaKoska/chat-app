<x-app-layout>
    <div class="max-w-md mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
    <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Your Comment</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Comment
            </label>
            <textarea
                name="comment"
                id="comment"
                rows="4"
                class="w-full mt-1 p-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                required
            >{{ old('comment', $comment->comment) }}</textarea>
            @error('comment')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="post_id" value="{{ $comment->post_id }}">

        <div class="flex justify-end gap-2">
            <a href="{{ url()->previous() }}"
               class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition">
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
</x-app-layout>
