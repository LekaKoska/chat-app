<?php

namespace App\Services;
use App\Enums\Socialite\ProvidersEnum;
use App\Models\User;
use App\Models\UserProvider;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class SocialiteService
{

    public function callback($provider): ?User
    {
        $data = Socialite::driver(driver: $provider)->user();
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

        return $user;
    }

}
