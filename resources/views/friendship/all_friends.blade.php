@vite('resources/css/app.css')
@vite('resources/js/app.js')

<div class="max-w-4xl mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-8 text-center">
        Your Friends
    </h2>
    @if($friends->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-400">You don’t have any friends yet 😢</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($friends as $friend)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 p-5 flex flex-col items-center">
                    <img
                        src="{{ asset('storage/images/avatars/' . $friend->avatar) }}"
                        alt="{{ $friend->name }}'s avatar"
                        class="w-24 h-24 rounded-full object-cover border-4 border-indigo-500 mb-4"
                    >
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                        {{ $friend->name }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Friend since {{ $friend->created_at->format('M Y') }}
                    </p>

                    <div class="mt-4 flex gap-3">
                        <a href=""
                           class="text-indigo-600 hover:text-indigo-800 dark:hover:text-indigo-400 text-sm font-medium">
                            View Profile
                        </a>
                        <form method="POST" action="{{ route('friends.request.remove', $friend->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-500 hover:text-red-700 dark:hover:text-red-400 text-sm font-medium">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
