<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class MakeReadNotificationController extends Controller
{
    public function read($id): RedirectResponse
    {
        $notification = auth()->user()->unreadNotifications()->find($id);
        if ($notification) {
            $notification->markAsRead();

            return redirect()->back();
        }
        return redirect()->back();
    }
}
