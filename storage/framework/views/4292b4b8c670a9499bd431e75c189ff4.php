<?php use App\Models\User; ?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-6">
    <h1 class="text-2xl font-semibold text-center mb-6 text-gray-800">
        👥 Add Friends
    </h1>

    <div class="space-y-4">
        <?php $__currentLoopData = User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->id() !== $user->id): ?>
                <div
                    class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-200 hover:bg-gray-100 transition">
                    <div class="flex items-center gap-3">
                        <div>
                            <img src="<?php echo e(asset('storage/images/avatars/' . $user->avatar)); ?>"
                                 class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-300" alt="profile_image">
                        </div>
                        <span class="text-gray-800 font-medium"><?php echo e($user->name); ?></span>
                    </div>

                    <form action="<?php echo e(route('friends.request.send', ['receiverId' => $user->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg transition duration-200"
                        >
                            ➕ Send Request
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if(session('success')): ?>
        <div class="mt-6 bg-green-100 text-green-800 text-sm font-medium p-3 rounded-lg border border-green-300">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mt-6 bg-red-100 text-red-800 text-sm font-medium p-3 rounded-lg border border-red-300">
            ⚠️ <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
</div>

</body>
</html>
<?php /**PATH C:\Users\alekk\Desktop\PROJEKTI\chat-app\resources\views/friendship/send_request.blade.php ENDPATH**/ ?>