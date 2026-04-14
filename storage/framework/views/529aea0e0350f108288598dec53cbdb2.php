<?php use App\Enums\FriendStatus; ?>
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incoming Friend Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .requests-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .request-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            font-weight: bold;
            color: #333;
        }

        .actions form {
            display: inline;
        }

        button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-left: 5px;
        }

        .accept {
            background-color: #22c55e;
            color: white;
        }

        .reject {
            background-color: #ef4444;
            color: white;
        }

        .empty {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>

<h1>Incoming Friend Requests</h1>

<div class="requests-container">
    <?php $__empty_1 = true; $__currentLoopData = $receiver; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="request-card">
            <div class="user-info">
                <?php echo e($request->sender->name); ?> sent you a friend request
            </div>

            <div class="actions">
                <form
                    action="<?php echo e(route('friends.request.respond', [$request->id, 'action' => FriendStatus::Accepted->value])); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="accept" value="<?php echo e(FriendStatus::Accepted->value); ?>">Accept</button>
                </form>
                <form
                    action="<?php echo e(route('friends.request.respond', [$request->id, 'action' => FriendStatus::Declined->value])); ?>"
                    method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field("PATCH"); ?>
                    <button type="submit" class="declined" value="<?php echo e(FriendStatus::Declined->value); ?>">Declined</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="empty">You have no pending friend requests.</p>
    <?php endif; ?>
</div>

</body>
</html>
<?php /**PATH C:\Users\alekk\Desktop\PROJEKTI\chat-app\resources\views/friendship/incoming_request.blade.php ENDPATH**/ ?>