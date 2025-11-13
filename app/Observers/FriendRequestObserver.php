<?php

namespace App\Observers;

use App\Enums\FriendStatus;
use App\Models\FriendConnectionModel;
use App\Notifications\FriendRequest;
use App\Notifications\FriendRequestAccepted;

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
        if ($friendRequest->wasChanged('status') && $friendRequest->status === FriendStatus::Accepted) {
            $sender = $friendRequest->sender;
            $accepter = $friendRequest->receiver;

            $sender->notify(new FriendRequestAccepted(accepter: $accepter));
        }
    }
}
