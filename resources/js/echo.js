import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
// Safely resolve authenticated user id if available on window
const resolvedReceiverId = (window && window.auth && window.auth.user && window.auth.user.id) ? window.auth.user.id : null;
if (!resolvedReceiverId) {
    // If no auth context is present, skip Echo setup to avoid breaking other JS (e.g., Alpine)
    // You can set window.auth = { user: { id: <id> } } in a Blade view when you need Echo
    // or move this import behind a route-specific entrypoint.
}
window.Pusher = Pusher;

if (resolvedReceiverId) {
    window.receiverId = resolvedReceiverId;
    window.Echo = new Echo({
        broadcaster: 'reverb',
        key: import.meta.env.VITE_REVERB_APP_KEY,
        wsHost: import.meta.env.VITE_REVERB_HOST,
        wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
        wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
        forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
        enabledTransports: ['ws', 'wss'],
    });
}

if (resolvedReceiverId && window.Echo) {
    window.Echo.private('chat.' + resolvedReceiverId)
        .listen('MessageSent', (e) => {
            console.log('Accepted message:', e.message.message);
            const chatBox = document.getElementById('chat-box');
            if (chatBox) {
                const msg = document.createElement('div');
                msg.textContent = e.message.message;
                chatBox.appendChild(msg);
            }
        });
}
