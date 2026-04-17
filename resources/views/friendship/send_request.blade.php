@php use App\Models\User; @endphp
<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                👥 Add Friends
            </h1>
            <a href="{{ route('posts.index') }}"
               class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                ← Back
            </a>
        </div>

        <div class="space-y-4">
            @foreach(User::all() as $user)
                @if(auth()->id() !== $user->id)
                    <div
                        class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <div class="flex items-center gap-3">
                            <div>
                                <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}"
                                     class="w-10 h-10 rounded-full object-cover border border-gray-300" alt="profile_image">
                            </div>
                            <span class="text-gray-800 dark:text-gray-100 font-medium">{{ $user->name }}</span>
                        </div>

                        <form action="{{ route('friends.request.send', ['receiverId' => $user->id]) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition duration-200"
                            >
                                ➕ Send Request
                            </button>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>

        @if(session('success'))
            <div class="mt-6 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm font-medium p-3 rounded-lg border border-green-300 dark:border-green-700">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-sm font-medium p-3 rounded-lg border border-red-300 dark:border-red-700">
                ⚠️ {{ session('error') }}
            </div>
        @endif
    </div>
    </div>
</x-app-layout>
