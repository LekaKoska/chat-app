<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{id}', function ($user, $receiverId) {
    return (int)$user->id === (int)$receiverId;
});
