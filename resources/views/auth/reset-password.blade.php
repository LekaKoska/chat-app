<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create New Password 🔑</h2>
        <p class="text-gray-600 dark:text-gray-400">Enter your new password below</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('📧 Email Address')"/>
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email"
                          :value="old('email', $request->email)" required autofocus autocomplete="username" disabled/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('🔐 New Password')"/>
            <x-text-input id="password" class="block mt-2 w-full" type="password" name="password" required
                          autocomplete="new-password" placeholder="At least 8 characters"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('✓ Confirm Password')"/>
            <x-text-input id="password_confirmation" class="block mt-2 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"
                          placeholder="Repeat password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
</x-guest-layout>
