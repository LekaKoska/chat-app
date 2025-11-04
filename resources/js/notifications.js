if (window.auth?.user?.id && window.Echo) {
    const userId = window.auth.user.id;

    const msgCountEl = document.getElementById('message-count');
    const msgListEl = document.getElementById('message-list');

    function incrementMsgBadge() {
        if (!msgCountEl) return;
        const current = parseInt(msgCountEl.textContent || '0', 10) || 0;
        msgCountEl.textContent = String(current + 1);
        msgCountEl.classList.remove('hidden');
    }

    function prependMessageItem(n) {
        if (!msgListEl) return;

        const a = document.createElement('a');
        a.href = n.url || '#';
        a.className = 'block px-4 py-2 flex items-center space-x-3 bg-white dark:bg-gray-900 hover:bg-gray-100 dark:hover:bg-gray-800 transition';

        const avatarPath = n.sender?.avatar ? `/storage/images/avatars/${n.sender.avatar}` : '/storage/images/avatars/default.png';

        a.innerHTML = `
      <img src="${avatarPath}"
           alt="avatar"
           class="w-10 h-10 rounded-full border border-gray-300 object-cover">
      <div class="flex-1">
        <div class="text-sm text-gray-800 dark:text-gray-200">${n.notification || 'New message'}</div>
        ${n.message?.text ? `<div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-1">${n.message.text}</div>` : ''}
      </div>
    `;

        const wrapper = document.createElement('div');
        wrapper.className = 'border-b border-gray-200 dark:border-gray-700';
        wrapper.appendChild(a);

        msgListEl.prepend(wrapper);

        const empty = document.getElementById('message-empty');
        if (empty) empty.remove();
    }

    window.Echo.private('App.Models.User.' + userId)
        .notification((notification) => {
            // Prikaži samo notifikacije za nove poruke u message ikoni
            if (notification?.type === 'new_message') {
                incrementMsgBadge();
                prependMessageItem(notification);
            }
        });
}


