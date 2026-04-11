<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function __invoke(User $user): RedirectResponse
    {
        $authUser = Auth::user();
        $user->with(['following', 'followers'])->withCount('followers');
        if ($authUser === $user->id) {
            abort(code: 403, message: 'You cannot follow yourself');
        }
        $authUser->following()->toggle($user->id);
        if ($authUser->following()->where('user_id', $user->id)->exists()) {
            $user->notify(new NewSubscriber($authUser));
        }

        return redirect()->back();
    }

}
