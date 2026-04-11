<?php use App\Models\Subscription;use Illuminate\Support\Facades\Auth; ?>

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
    <div class="min-h-screen bg-gray-100 flex justify-center py-10">
        <div class="bg-white shadow-lg rounded-2xl w-full max-w-2xl p-8">

            <div class="flex flex-col items-center">
                <img
                    src="<?php echo e(asset('storage/images/avatars/' . $user->avatar)); ?>"
                    alt="<?php echo e($user->name); ?>"
                    class="w-32 h-32 rounded-full border-4 border-indigo-500 shadow-md object-cover"
                >

                <h2 class="mt-4 text-2xl font-semibold text-gray-800"><?php echo e($user->name); ?></h2>
                <p class="text-gray-500 text-sm"><?php echo e($user->email); ?></p>

                <p class="mt-2 text-xs text-gray-400">
                    Joined <?php echo e($user->created_at->format('d M Y')); ?>

                </p>
            </div>

            <div class="mt-8 grid grid-cols-3 text-center border-t border-gray-200 pt-6">
                <div>
                    <p class="text-xl font-bold text-gray-700"><?php echo e($user->posts_count ?? 0); ?></p>
                    <p class="text-gray-500 text-sm">Posts</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-700"><?php echo e($user->friends->count() ?? 0); ?></p>
                    <p class="text-gray-500 text-sm">Friends</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-700"><?php echo e($user->followers_count ?? 0); ?></p>
                    <p class="text-gray-500 text-sm">Subscribers</p>
                </div>
            </div>
            <?php if (! ($user->id === Auth::id())): ?>
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">

                    <a href="<?php echo e(route('chat.form', ['receiverId' => $user->id])); ?>"
                       class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                        💬 Message <?php echo e($user->name); ?>

                    </a>
                    <?php
                        $isSubscribed = Auth::user()->following->contains($user->id);
                    ?>
                    <?php if(!$isSubscribed): ?>
                        <a href="<?php echo e(route('subscription', ['user' => $user->id])); ?>"
                           class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                            ⭐ Subscribe to <?php echo e($user->name); ?>

                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('subscription', ['user' => $user->id])); ?>"
                           class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                            Unsubscribe
                        </a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <?php if($user->friends->count() > 0): ?>
                <div class="mt-10">
                    <?php if(\auth()->id() === $user->id): ?>
                        <a href="<?php echo e(route('friends.request.index')); ?>"><h3 class="text-lg font-semibold text-gray-800 mb-4 p-2 rounded hover:bg-gray-100 transition-colors duration-200">
                                Friends
                            </h3>
                        </a>
                    <div class="grid grid-cols-2 gap-4">
                        <?php else: ?>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Friends</h3>
                        <?php endif; ?>
                        <?php $__currentLoopData = $user->friends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $friend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div
                                class="flex items-center bg-gray-50 p-3 rounded-xl shadow-sm hover:bg-gray-100 transition">
                                <a href="<?php echo e(route('profile.info', ['user' => $friend->name])); ?>">
                                    <img src="<?php echo e(asset('storage/images/avatars/' . $friend->avatar)); ?>"
                                         class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-300">
                                </a>

                                <div>
                                    <p class="text-gray-800 font-medium"><?php echo e($friend->name); ?></p>
                                    <p class="text-xs text-gray-500"><?php echo e($friend->email); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php if(\auth()->id() === $user->id): ?>
                <div>
                    <a href="<?php echo e(route('friends.request.show')); ?>">Add friends</a>
                </div>
                <?php endif; ?>
            <?php else: ?>
                <p class="mt-10 text-center text-gray-500 italic">This user has no friends yet 😅</p>
            <?php endif; ?>

        </div>
    </div>

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
<?php /**PATH /var/www/html/resources/views/profile/info.blade.php ENDPATH**/ ?>