@php use App\Enums\Socialite\ProvidersEnum; @endphp
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')"/>

    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back! 👋</h2>
        <p class="text-gray-600 dark:text-gray-400">Sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('📧 Email Address')"/>
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('🔐 Password')"/>
            <x-text-input id="password" class="block mt-2 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800 transition"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            {{ __('Don\'t have an account?') }}
            <a class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold transition"
               href="{{ route('register') }}">
                {{ __('Sign up now') }}
            </a>
        </div>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">Or continue with</span>
            </div>
        </div>

        <!-- Social Login -->
        <div class="flex items-center justify-center gap-3">
            <a href="{{ route('auth.redirect', ProvidersEnum::Google) }}"
               class="flex-1 p-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-200 shadow-sm flex items-center justify-center gap-2">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-4 h-4">
                <span class="hidden sm:inline text-sm font-medium text-gray-700 dark:text-gray-300">Google</span>
            </a>
        </div>
    </form>
</x-guest-layout>
