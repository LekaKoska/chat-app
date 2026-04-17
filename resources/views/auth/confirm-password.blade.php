<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Confirm Password 🔐</h2>
    </div>

    <!-- Info -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 mb-6">
        <p class="text-sm text-blue-700 dark:text-blue-300">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('🔐 Password')"/>
            <x-text-input id="password" class="block mt-2 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
