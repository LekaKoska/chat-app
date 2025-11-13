<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class SocialiteController extends Controller
{
    public function redirectTo($provider): RedirectResponse
    {
        return Socialite::driver(driver: $provider)->redirect();
    }

    public function handleCallback($provider, SocialiteService $socialiteService): RedirectResponse
    {
        $user = $socialiteService->callback($provider);
        Auth::login($user, remember: true);
        request()->session()->regenerate();
        return redirect()->route('posts.index');
    }
}


