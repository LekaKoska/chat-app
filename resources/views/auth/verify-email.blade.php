<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Verify Your Email 📬</h2>
    </div>

    <!-- Info -->
    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-6">
        <p class="text-sm text-yellow-700 dark:text-yellow-300">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4">
            <p class="text-sm text-green-700 dark:text-green-300 font-medium">
                ✅ {{ __('A new verification link has been sent to your email.') }}
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full">
                <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-center text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 font-semibold py-2 transition">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</x-guest-layout>
