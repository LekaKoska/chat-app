@php use App\Enums\FriendStatus; @endphp
<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">📨 Incoming Friend Requests</h1>
            <a href="{{ route('friends.request.show') }}"
               class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                ➕ Add Friends
            </a>
        </div>

        <div class="space-y-4">
            @forelse($receiver as $request)
                <div class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-gray-200 dark:border-gray-700 flex items-center justify-between hover:shadow-md transition">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/images/avatars/' . $request->sender->avatar) }}"
                             alt="{{ $request->sender->name }}"
                             class="w-12 h-12 rounded-full object-cover border border-gray-300">
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $request->sender->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">sent you a friend request</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <form
                            action="{{ route('friends.request.respond', [$request->id, 'action' => FriendStatus::Accepted->value]) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">Accept</button>
                        </form>
                        <form
                            action="{{ route('friends.request.respond', [$request->id, 'action' => FriendStatus::Declined->value]) }}"
                            method="POST"
                            class="inline">
                            @csrf
                            @method("PATCH")
                            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">Decline</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400">You have no pending friend requests. <a href="{{ route('friends.request.show') }}" class="text-indigo-600 hover:underline">Find friends to add?</a></p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
