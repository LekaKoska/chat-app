@php@endphp
<x-app-layout>
    <div class="max-w-2xl mx-auto px-4 py-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">💬 Messages</h1>
            <a href="{{ route('posts.index') }}"
               class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                ← Back
            </a>
        </div>
        <div
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">

            <div
                class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Chat</h2>
                @if(!empty($receiverId) && $receiverId !== auth()->id())
                    <span class="text-sm text-gray-500 dark:text-gray-400">Chat with #{{ $receiverId }}</span>
                @else
                    <span class="text-sm text-gray-400">No selected receiver</span>
                @endif
            </div>

            <div id="chat-box" class="h-80 overflow-y-auto p-4 space-y-3 bg-gray-50 dark:bg-gray-900">
                @forelse($messages ?? [] as $message)
                    <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[75%] {{ $message->sender_id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' }} px-4 py-2 rounded-xl rounded-{{ $message->sender_id === auth()->id() ? 'br' : 'bl' }}-none">
                            <p class="text-sm">{{ $message->message }}</p>
                            <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-indigo-100' : 'text-gray-500 dark:text-gray-400' }} mt-1">{{ $message->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                @empty
                    <p id="no-messages" class="text-center text-gray-400">No messages yet. Start a conversation!</p>
                @endforelse
            </div>

            @if(!empty($receiverId) && $receiverId !== auth()->id())
                <form id="chat-form" method="POST" action="{{ route('chat') }}"
                      class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-4">
                    @csrf
                    <input id="receiver-id" type="hidden" name="receiver_id" value="{{ $receiverId }}">

                    <div class="flex items-center space-x-2">
                        <input
                            type="text"
                            name="message"
                            id="message"
                            placeholder="Type message..."
                            class="flex-1 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 px-3 py-2"
                            autocomplete="off"
                            required
                        >
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-150 ease-in-out"
                        >
                            Send
                        </button>
                    </div>
                </form>
            @else
                <div
                    class="p-4 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                    Cannot send message to self
                </div>
            @endif
        </div>
    </div>

    <script>
        window.auth = {user: {id: {{ auth()->id() }}}};
        const receiverId = document.getElementById('receiver-id')?.value;
        const chatBox = document.getElementById('chat-box');
        const currentUserId = {{ auth()->id() }};

        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function addMessageToChat(msgData, isSent = true) {
            const div = document.createElement('div');
            div.classList.add('flex', isSent ? 'justify-end' : 'justify-start');

            const time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
            const msgClass = isSent
                ? 'bg-indigo-600 text-white rounded-br-none'
                : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-bl-none';
            const timeClass = isSent ? 'text-indigo-100' : 'text-gray-500 dark:text-gray-400';

            div.innerHTML = `
                <div class="max-w-[75%] ${msgClass} px-4 py-2 rounded-xl">
                    <p class="text-sm">${msgData.message || msgData.text || msgData}</p>
                    <p class="text-xs ${timeClass} mt-1">${time}</p>
                </div>
            `;

            chatBox.appendChild(div);
            document.getElementById('no-messages')?.remove();
            scrollToBottom();
        }

        document.getElementById('chat-form')?.addEventListener('submit', async function (e) {
            e.preventDefault();
            const form = e.target;
            const body = new FormData(form);

            const res = await fetch('{{ route('chat') }}', {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body
            });

            const msg = await res.json();
            addMessageToChat(msg, true);
            form.reset();
        });

        if (window.Echo && receiverId) {
            const senderId = currentUserId;
            const channelId = 'chat.' + Math.min(senderId, parseInt(receiverId)) + '.' + Math.max(senderId, parseInt(receiverId));

            window.Echo.private(channelId)
                .listen('MessageSent', (e) => {
                    if (e.message.sender_id !== currentUserId) {
                        console.log('Received message:', e.message);
                        addMessageToChat(e.message, false);
                    }
                });
        }

        document.addEventListener('DOMContentLoaded', scrollToBottom);
    </script>
</x-app-layout>
