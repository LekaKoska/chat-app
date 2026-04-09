<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class MakeReadNotificationController extends Controller
{
    public function read($id): RedirectResponse
    {
        $notification = auth()->user()->notifications()->find($id);
        if (!$notification) {
            return redirect()->back();
        }
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        $url = data_get($notification->data, 'url');
        if (!$url) {
            return redirect()->back();
        }
        return redirect()->to($url);
    }
}
