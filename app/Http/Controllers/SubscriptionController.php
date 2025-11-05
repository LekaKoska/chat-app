<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function subscription(User $user): RedirectResponse
    {
        $authUser = Auth::user();
        $user->with(['following', 'followers'])->withCount('followers');
        if($authUser === $user->id)
        {
            abort(code: 403, message: 'You cannot follow yourself');
        }
        $authUser->following()->toggle($user->id);

        return redirect()->back();
    }

}
