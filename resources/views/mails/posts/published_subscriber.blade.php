<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>New post notification</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .email-container {
            max-width: 680px;
            margin: 0 auto;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
<span
    style="display:none!important;visibility:hidden;mso-hide:all;font-size:1px;color:#fff;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">{{ Str::limit(strip_tags($post->content), 80) }} — New post from {{ $post->ownerOfPost->name }}</span>

<div class="email-container mx-auto my-8 bg-white shadow-md rounded-xl overflow-hidden">
    <div class="p-6 bg-gradient-to-r from-indigo-600 to-sky-500 text-white">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center overflow-hidden">
                @if(isset($post->ownerOfPost->avatar))
                    <img src="/storage/images/avatars/{{ $post->ownerOfPost->avatar }}"
                         alt="{{ $post->ownerOfPost->name }}" class="w-14 h-14 object-cover rounded-full">
                @else
                    <span class="uppercase font-bold">{{ substr($post->ownerOfPost->name,0,1) }}</span>
                @endif
            </div>
            <div>
                <p class="text-sm opacity-90">New post</p>
                <h1 class="text-xl font-semibold">{{ $post->ownerOfPost->name }} published a post</h1>
            </div>
        </div>
    </div>

    <div class="p-6">
        <p class="text-gray-700 mb-4">Hello,</p>

        <p class="text-gray-700 mb-4">{{ $post->ownerOfPost->name }} just published a new post. Here’s a quick
            preview:</p>

        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4 mb-5">
            <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ Str::limit(strip_tags($post->content), 80) }}</h2>
            <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($post->content), 250, '...') }}</p>
        </div>

        <div class="mb-6">
            <a href="{{route('posts.show', ['post' => $post->id])}}}" class="btn bg-indigo-600 text-white"
               style="background-color:#4f46e5;color:#fff;border-radius:8px;padding:12px 20px;">Read the full post</a>
        </div>

        <p class="text-sm text-gray-600">Want to hear more from <strong>{{ $post->ownerOfPost->name }}</strong>? Keep
            following them to get the latest updates.</p>

    </div>

    <div class="bg-gray-50 p-4 text-xs text-gray-500 text-center">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</div>


<div class="mx-auto max-w-xl text-center text-xs text-gray-400 mt-6">
    <p>This email was generated because you subscribed to {{ $post->ownerOfPost->name }}.</p>
</div>
</body>
</html>
