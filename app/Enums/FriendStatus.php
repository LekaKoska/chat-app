<?php

namespace App\Enums;

enum FriendStatus: string
{
    case Accepted = 'accepted';
    case Pending = 'pending';
    case Declined = 'declined';
}
