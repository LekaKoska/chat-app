<?php

namespace App\Http\Controllers;

use App\Enums\FriendStatus;
use App\Models\FriendConnectionModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FriendConnectionController extends Controller
{
    use AuthorizesRequests;

    public function request(): View
    {
        return view(view: 'friendship.send_request');
    }
    public function sendRequest($receiverId): RedirectResponse
    {
        $senderId = \auth()->id();
       if($senderId === $receiverId)
       {
           return redirect()->back()->with(key: 'error' , value: 'You cannot add yourself as friend');
       }

       $exists = FriendConnectionModel::where(function ($q) use ($senderId, $receiverId)
       {
          $q->where('sender_id', $senderId)
              ->where('receiver_id', $receiverId);
       })
           ->orWhere(function ($q) use ($senderId, $receiverId) {
               $q->where('sender_id', $receiverId)
                   ->where('receiver_id', $senderId);
           })->exists();

        if($exists) {
            return redirect()->back()->with(key: 'error' , value: 'Friend request already exist!');
        }

        FriendConnectionModel::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => FriendStatus::Pending->value
        ]);

        return redirect()->back()->with(key: 'success', value: 'Successfully sent request');
    }

    public function incomingRequest(): View
    {
        $receiver = FriendConnectionModel::where('receiver_id', auth()->id())
           ->where('status', FriendStatus::Pending->value)->with('sender')->get();

        return view(view: 'friendship.incoming_request', data: compact('receiver'));
    }

    public function respondRequest(Request $request, FriendConnectionModel $friendship, string $action): RedirectResponse
    {
        $this->authorize('handleRequest', $friendship);

        $allowedActions = [
            FriendStatus::Accepted->value,
            FriendStatus::Declined->value,
        ];

        if (!in_array($action, $allowedActions)) {
            abort(400, 'Invalid friend status action.');
        }

        $friendship->update(['status' => $action]);
        return redirect()->back()->with(key: 'success', value: 'Friend request is successfully confirmed!');
    }

}
