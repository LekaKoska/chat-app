<?php?>
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="max-w-2xl mx-auto p-6">
        <div
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">

            <div
                class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Chat</h2>
                <?php if(!empty($receiverId) && $receiverId !== auth()->id()): ?>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Chat with #<?php echo e($receiverId); ?></span>
                <?php else: ?>
                    <span class="text-sm text-gray-400">No selected receiver</span>
                <?php endif; ?>
            </div>

            <div id="chat-box" class="h-80 overflow-y-auto p-4 space-y-3 bg-gray-50 dark:bg-gray-900">
                <p id="no-messages" class="text-center text-gray-400">No message</p>
            </div>

            <?php if(!empty($receiverId) && $receiverId !== auth()->id()): ?>
                <form id="chat-form" method="POST" action="<?php echo e(route('chat')); ?>"
                      class="border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-4">
                    <?php echo csrf_field(); ?>
                    <input id="receiver-id" type="hidden" name="receiver_id" value="<?php echo e($receiverId); ?>">

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
            <?php else: ?>
                <div
                    class="p-4 text-center text-sm text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
                    Cannot send message to self
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        window.auth = {user: {id: <?php echo e(auth()->id()); ?>}};
        const receiverId = document.getElementById('receiver-id')?.value;
        const chatBox = document.getElementById('chat-box');


        function scrollToBottom() {
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        document.getElementById('chat-form')?.addEventListener('submit', async function (e) {
            e.preventDefault();
            const form = e.target;
            const body = new FormData(form);

            const res = await fetch('<?php echo e(route('chat')); ?>', {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'},
                body
            });

            const msg = await res.json();

            const div = document.createElement('div');
            div.classList.add('flex', 'justify-end');
            div.innerHTML = `
                <div class="max-w-[75%] bg-indigo-600 text-white px-4 py-2 rounded-xl rounded-br-none shadow">
                    ${msg.message}
                </div>
            `;
            chatBox.appendChild(div);

            document.getElementById('no-messages')?.remove();

            form.reset();
            scrollToBottom();
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\alekk\Desktop\PROJEKTI\chat-app\resources\views/chat.blade.php ENDPATH**/ ?>