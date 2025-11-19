<?php

namespace App\Observers;

use App\Models\Vote;
use App\Notifications\Voting;
use Illuminate\Support\Facades\Cache;

class VoteObserver
{
    private function notifyPostOwner(Vote $vote): void
    {
        $postOwner = $vote->post->ownerOfPost;
        if (!$postOwner || $postOwner->id === $vote->user_id) {
            return;
        }
        $postOwner->notify(new Voting(user: $vote->user, vote: $vote));
    }

    public function created(Vote $vote): void
    {
        Cache::tags(['posts'])->flush();
        $this->notifyPostOwner($vote);
    }

    public function updated(Vote $vote): void
    {
        if ($vote->wasChanged('vote')) {
            $this->notifyPostOwner($vote);
        }
    }

}
