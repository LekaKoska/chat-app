@php use App\Models\User; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Friends</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-10">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-6">
    <h1 class="text-2xl font-semibold text-center mb-6 text-gray-800">
        👥 Add Friends
    </h1>

    <div class="space-y-4">
        @foreach(User::all() as $user)
            @if(auth()->id() !== $user->id)
                <div
                    class="flex items-center justify-between bg-gray-50 p-4 rounded-xl border border-gray-200 hover:bg-gray-100 transition">
                    <div class="flex items-center gap-3">
                        <div>
                            <img src="{{ asset('storage/images/avatars/' . $user->avatar) }}"
                                 class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-300" alt="profile_image">
                        </div>
                        <span class="text-gray-800 font-medium">{{ $user->name }}</span>
                    </div>

                    <form action="{{ route('friends.request.send', ['receiverId' => $user->id]) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-lg transition duration-200"
                        >
                            ➕ Send Request
                        </button>
                    </form>
                </div>
            @endif
        @endforeach
    </div>

    @if(session('success'))
        <div class="mt-6 bg-green-100 text-green-800 text-sm font-medium p-3 rounded-lg border border-green-300">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mt-6 bg-red-100 text-red-800 text-sm font-medium p-3 rounded-lg border border-red-300">
            ⚠️ {{ session('error') }}
        </div>
    @endif
</div>

</body>
</html>
