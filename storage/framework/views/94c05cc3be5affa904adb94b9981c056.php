<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Comment</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

<div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6">
    <h1 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Your Comment</h1>

    <form action="<?php echo e(route('comments.update', $comment->id)); ?>" method="POST" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

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
            ><?php echo e(old('comment', $comment->comment)); ?></textarea>
            <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <input type="hidden" name="post_id" value="<?php echo e($comment->post_id); ?>">

        <div class="flex justify-end gap-2">
            <a href="<?php echo e(url()->previous()); ?>"
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

</body>
</html>
<?php /**PATH C:\Users\alekk\Desktop\PROJEKTI\chat-app\resources\views/comments/edit.blade.php ENDPATH**/ ?>