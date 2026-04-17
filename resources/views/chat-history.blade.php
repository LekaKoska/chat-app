@php use Illuminate\Support\Str; @endphp
<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">💬 Message History</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">All your conversations in one place</p>
        </div>

        @if($chats->isEmpty())
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400 text-lg">No conversations yet</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Start chatting with friends to see your conversations here</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($chats as $chat)
                    <a href="{{ route('chat.form', ['receiverId' => $chat['user']->id]) }}"
                       class="block bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md dark:hover:shadow-lg transition">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0">
                                <img src="{{ $chat['user']->avatar ? asset('storage/images/avatars/' . $chat['user']->avatar) : asset('storage/images/avatars/default-avatar.png') }}"
                                     alt="{{ $chat['user']->name }}"
                                     class="w-12 h-12 rounded-full object-cover border border-gray-300">
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $chat['user']->name }}
                                    </h3>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $chat['lastMessage']?->created_at?->diffForHumans() ?? 'No messages' }}
                                    </span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600 dark:text-gray-300 truncate max-w-md">
                                        @if($chat['lastMessage'])
                                            <span class="font-medium">{{ $chat['lastMessage']->sender_id === auth()->id() ? 'You: ' : '' }}</span>
                                            {{ Str::limit($chat['lastMessage']->message, 50) }}
                                        @else
                                            <span class="text-gray-400">No messages yet</span>
                                        @endif
                                    </p>

                                    @if($chat['unreadCount'] > 0)
                                        <span class="inline-flex items-center justify-center ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                            {{ $chat['unreadCount'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L12.586 8 7.293 2.707a1 1 0 011.414-1.414l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
