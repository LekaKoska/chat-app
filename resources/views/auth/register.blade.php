<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Create Your Account 🚀</h2>
        <p class="text-gray-600 dark:text-gray-400">Join us and start connecting with friends</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('👤 Full Name')"/>
            <x-text-input id="name" class="block mt-2 w-full" type="text" name="name" :value="old('name')" required
                          autofocus autocomplete="name" placeholder="John Doe"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('📧 Email Address')"/>
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username" placeholder="you@example.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('🔐 Password')"/>
            <x-text-input id="password" class="block mt-2 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"
                          placeholder="At least 8 characters"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('✓ Confirm Password')"/>
            <x-text-input id="password_confirmation" class="block mt-2 w-full"
                          type="password"
                          name="password_confirmation"
                          required autocomplete="new-password"
                          placeholder="Repeat password"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Password Info -->
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
            <p class="text-xs text-blue-700 dark:text-blue-300">
                💡 <strong>Password must:</strong> Contain at least 8 characters with uppercase, lowercase, and numbers
            </p>
        </div>

        <!-- Register Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <!-- Login Link -->
        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            {{ __('Already have an account?') }}
            <a class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold transition"
               href="{{ route('login') }}">
                {{ __('Sign in here') }}
            </a>
        </div>

        <!-- Terms -->
        <div class="text-center text-xs text-gray-500 dark:text-gray-500 mt-4">
            <p>By signing up, you agree to our <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Terms of Service</a> and <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Privacy Policy</a></p>
        </div>
    </form>
</x-guest-layout>
