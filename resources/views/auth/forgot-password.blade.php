<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Reset Your Password 🔒</h2>
    </div>

    <!-- Info -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
        <p class="text-sm text-blue-700 dark:text-blue-300">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('📧 Email Address')"/>
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required
                          autofocus placeholder="you@example.com"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>

        <!-- Back to Login -->
        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            <a class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold"
               href="{{ route('login') }}">
                ← Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
