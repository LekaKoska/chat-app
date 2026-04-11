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
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>All Posts</title>
        <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
        <?php echo app('Illuminate\Foundation\Vite')('resources/js/app.js'); ?>
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

    <div class="max-w-2xl mx-auto px-4 space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Community Feed</h1>
        <div class="mb-6">
            <form action="<?php echo e(route('posts.search')); ?>" method="GET" class="flex items-center gap-2">
                <input type="text"
                       name="search"
                       value="<?php echo e(request('search')); ?>"
                       placeholder="Search discussion..."
                       class="flex-1 px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                >

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    Search
                </button>
            </form>
        </div>

        <div x-data="{ open: false }" class="relative mb-6">
            <button @click="open = !open"
                    type="button"
                    class="w-40 flex justify-between items-center px-4 py-2 rounded-2xl bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none"
                    aria-haspopup="true" aria-expanded="open">
                Sort by
                <svg class="ml-2 h-5 w-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" @click.away="open = false" x-cloak
                 class="absolute mt-2 w-40 rounded-2xl shadow-sm bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 z-20">
                <a href="<?php echo e(route('posts.sort', array_merge(request()->query(), ['sort' => 'recent']))); ?>"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl <?php echo e(request('sort') === 'recent' ? 'font-bold bg-gray-100 dark:bg-gray-700' : ''); ?>">
                    Recent
                </a>
                <a href="<?php echo e(route('posts.sort', array_merge(request()->query(), ['sort' => 'likes']))); ?>"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl <?php echo e(request('sort') === 'likes' ? 'font-bold bg-gray-100 dark:bg-gray-700' : ''); ?>">
                    Most liked
                </a>
                <a href="<?php echo e(route('posts.sort', array_merge(request()->query(), ['sort' => 'comments']))); ?>"
                   @click="open = false"
                   class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-2xl <?php echo e(request('sort') === 'comments' ? 'font-bold bg-gray-100 dark:bg-gray-700' : ''); ?>">
                    Most commented
                </a>
            </div>
        </div>
        <div class="flex justify-end mb-6">
            <a href="<?php echo e(route('posts.create')); ?>"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                Add New Post
            </a>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('posts.show', $post->id)); ?>" class="block hover:shadow-lg transition rounded-2xl">
                <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 transition hover:shadow-md">
                    <div class="flex items-start gap-4">
                        <div class="flex flex-col items-center w-12 text-center select-none">
                            <form method="POST" action="<?php echo e(route('posts.upvote', $post->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center rounded hover:bg-gray-200 transition-colors
                <?php echo e(optional($post->userVote)->vote === 1 ? 'text-green-500 font-bold' : 'text-gray-500'); ?>">
                                    ▲
                                </button>
                            </form>

                            <div class="my-1 font-semibold text-gray-700">
                                <?php echo e($post->votes_score ?? 0); ?>

                            </div>

                            <form method="POST" action="<?php echo e(route('posts.downvote', $post->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="vote" value="-1">
                                <button type="submit"
                                        class="w-10 h-10 flex items-center justify-center rounded hover:bg-gray-200 transition-colors
                <?php echo e(optional($post->userVote)->vote === -1  ? 'text-red-500 font-bold' : 'text-gray-500'); ?>">
                                    ▼
                                </button>
                            </form>
                        </div>

                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                            <img
                                src="<?php echo e($post->ownerOfPost->avatar
                                    ? asset('storage/images/avatars/' . $post->ownerOfPost->avatar)
                                    : asset('storage/images/avatars/default-avatar.png')); ?>"
                                alt="Avatar"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h2 class="font-semibold text-gray-900 dark:text-gray-100">
                                    <?php echo e($post->ownerOfPost->name); ?>

                                </h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    <?php echo e($post->created_at->diffForHumans()); ?>

                                </p>
                            </div>

                            <p class="mt-2 text-gray-800 dark:text-gray-200 leading-relaxed">
                                <?php echo e($post->content); ?>

                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-gray-500 dark:text-gray-400">No posts yet.</p>
        <?php endif; ?>
    </div>

    <?php if($posts->hasPages()): ?>
        <div class="pt-6">
            <?php echo e($posts->appends(request()->query())->links('pagination::tailwind')); ?>

        </div>
    <?php endif; ?>

    </body>
    </html>
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
<?php /**PATH C:\Users\alekk\Desktop\PROJEKTI\chat-app\resources\views/posts/all.blade.php ENDPATH**/ ?>