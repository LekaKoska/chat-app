<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Post Is Published!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 py-10">
<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
    <div class="bg-indigo-600 text-white text-center py-6">
        <h1 class="text-2xl font-bold">🎉 Your Post Is Now Published!</h1>
    </div>

    <div class="p-6">
        <p class="text-gray-800 mb-4">
            Hi <span class="font-semibold">{{ $post->ownerOfPost->name }}</span>,
        </p>

        <p class="text-gray-700 mb-4">
            Great news! Your post has been successfully reviewed and is now live on our platform.
        </p>

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Your post:</h2>
            <p class="text-gray-700 italic">"{{ $post->content }}"</p>
            <p class="text-sm text-green-600 mt-2 font-medium">Status: {{ ucfirst($post->status->value) }}</p>
        </div>

        <p class="text-gray-700">
            You can view or edit your post anytime by visiting your profile.
        </p>

        <div class="mt-6 text-center">
            <a href="{{ route('posts.show', $post->id) }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                View Post
            </a>
        </div>
    </div>

    <div class="bg-gray-100 text-center text-gray-500 text-sm py-4">
        <p>Thank you for sharing your thoughts with our community 💬</p>
        <p class="mt-1">— The {{ config('app.name') }} Team</p>
    </div>
</div>
</body>
</html>
