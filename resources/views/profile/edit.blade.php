@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Friends') }}
                    </h3>

                    <div
                        class="flex items-center justify-between bg-gray-50 dark:bg-gray-900 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                        <span class="text-gray-700 dark:text-gray-300">
                            Total friends:
                        </span>
                        <span class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ $user->friends->count() }}
                        </span>
                    </div>

                </div>
            </div>

            <div class="p-6 sm:p-10 bg-white dark:bg-gray-800 shadow-xl rounded-2xl max-w-2xl mx-auto">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Profile Avatar</h2>

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
                    {{-- Current avatar --}}
                    <div class="flex flex-col items-center">
                        <div class="w-36 h-36 rounded-full overflow-hidden shadow-md border-4 border-indigo-500/50">
                            <img
                                id="avatarPreview"
                                src="{{ $user->avatar ? asset('storage/images/avatars/' . $user->avatar) : asset('default-avatar.png') }}"
                                alt="User Avatar"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->name ?? 'User' }}
                        </p>
                    </div>

                    {{-- Upload form --}}
                    <div class="flex-1 w-full">
                        <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label for="profile_image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Choose a new profile picture
                                </label>
                                <input
                                    type="file"
                                    name="profile_image"
                                    id="profile_image"
                                    accept="image/*"
                                    class="block w-full text-sm text-gray-900 dark:text-gray-200
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-full file:border-0
                               file:text-sm file:font-semibold
                               file:bg-indigo-600 file:text-white
                               hover:file:bg-indigo-700 cursor-pointer"
                                >
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-all duration-200"
                            >
                                ⬆️ Upload
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('profile_image').addEventListener('change', function(event) {
                    const [file] = event.target.files;
                    if (file) {
                        const preview = document.getElementById('avatarPreview');
                        preview.src = URL.createObjectURL(file);
                    }
                });
            </script>


            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
