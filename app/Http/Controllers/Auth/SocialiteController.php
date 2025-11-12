<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Socialite\ProvidersEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class SocialiteController extends Controller
{
    public function redirectTo($provider): RedirectResponse
    {

        return Socialite::driver($provider)->redirect();
    }
    public function handleCallback(): RedirectResponse
    {
        $data = Socialite::driver('google')->user();

        $user = User::updateOrCreate(['email' => $data->getEmail()],
            [
                'name' => $data->getName(),
                'email' => $data->getEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(40))
            ]);

             UserProvider::firstOrCreate(['user_id' => $user->id],
            [
                'provider_id' => $data->getId(),
                'provider_name' => ProvidersEnum::Google
            ]);

            Auth::login($user, remember: true);
            request()->session()->regenerate();

        return redirect()->route('posts.index');
         }
}


