<?php

namespace App\Http\Controllers;

class MakeReadNotificationController extends Controller
{
    public function read($id)
    {
        $notification = auth()->user()->unreadNotifications()->find($id);

        if ($notification) {
            $notification->markAsRead();

            return redirect()->back();
        }

        return redirect()->back();
    }
}
