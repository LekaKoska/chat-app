<?php

namespace App\Observers;

use App\Enums\FriendStatus;
use App\Models\FriendConnectionModel;
use App\Notifications\FriendRequest;
use App\Notifications\FriendRequestAccepted;
use Illuminate\Support\Facades\Cache;

class FriendRequestObserver
{
    public function created(FriendConnectionModel $friendRequest): void
    {
        $receiver = $friendRequest->receiver;
        $sender = $friendRequest->sender;

        $receiver->notify(new FriendRequest(user: $sender));

    }

    public function updated(FriendConnectionModel $friendRequest): void
    {
        Cache::tags(["user:$friendRequest->receiver_id"])->flush();
        if ($friendRequest->wasChanged('status') && $friendRequest->status === FriendStatus::Accepted) {
            $sender = $friendRequest->sender;
            $accepter = $friendRequest->receiver;

            $sender->notify(new FriendRequestAccepted(accepter: $accepter));
        }
    }
}
