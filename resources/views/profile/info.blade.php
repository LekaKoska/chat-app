@php use App\Models\Subscription;use Illuminate\Support\Facades\Auth; @endphp

<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex justify-center py-10">
        <div class="bg-white shadow-lg rounded-2xl w-full max-w-2xl p-8">

            <div class="flex flex-col items-center">
                <img
                    src="{{ asset('storage/images/avatars/' . $user->avatar) }}"
                    alt="{{ $user->name }}"
                    class="w-32 h-32 rounded-full border-4 border-indigo-500 shadow-md object-cover"
                >

                <h2 class="mt-4 text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>

                <p class="mt-2 text-xs text-gray-400">
                    Joined {{ $user->created_at->format('d M Y') }}
                </p>
            </div>

            <div class="mt-8 grid grid-cols-3 text-center border-t border-gray-200 pt-6">
                <div>
                    <p class="text-xl font-bold text-gray-700">{{ $user->posts_count ?? 0 }}</p>
                    <p class="text-gray-500 text-sm">Posts</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-700">{{ $user->friends->count() ?? 0 }}</p>
                    <p class="text-gray-500 text-sm">Friends</p>
                </div>
                <div>
                    <p class="text-xl font-bold text-gray-700">{{$user->followers_count ?? 0}}</p>
                    <p class="text-gray-500 text-sm">Subscribers</p>
                </div>
            </div>
            @unless($user->id === Auth::id())
                <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">

                    <a href="{{ route('chat.form', ['receiverId' => $user->id]) }}"
                       class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                        💬 Message {{ $user->name }}
                    </a>
                    @php
                        $isSubscribed = Auth::user()->following->contains($user->id);
                    @endphp
                    @if(!$isSubscribed)
                        <a href="{{route('subscription', ['user' => $user->id])}}"
                           class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                            ⭐ Subscribe to {{ $user->name }}
                        </a>
                    @else
                        <a href="{{route('subscription', ['user' => $user->id])}}"
                           class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full text-sm font-medium shadow-md transition transform hover:scale-105">
                            Unsubscribe
                        </a>
                    @endif

                </div>
            @endunless

            @if($user->friends->count() > 0)
                <div class="mt-10">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Friends</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($user->friends as $friend)
                            <div
                                class="flex items-center bg-gray-50 p-3 rounded-xl shadow-sm hover:bg-gray-100 transition">
                                <a href="{{route('profile.info', ['user' => $friend->name])}}">
                                    <img src="{{ asset('storage/images/avatars/' . $friend->avatar) }}"
                                         class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-300">
                                </a>

                                <div>
                                    <p class="text-gray-800 font-medium">{{ $friend->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $friend->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="mt-10 text-center text-gray-500 italic">This user has no friends yet 😅</p>
            @endif

        </div>
    </div>

</x-app-layout>
