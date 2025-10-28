<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->ownerOfPost->name }}'s Post</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen py-8">

<div class="max-w-2xl mx-auto px-4 space-y-6">


    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 transition hover:shadow-md">
        <div class="flex items-start gap-4">

            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                <img
                    src="{{ $post->ownerOfPost->avatar
                                ? asset('storage/images/avatars/' . $post->ownerOfPost->avatar)
                                : asset('default-avatar.png') }}"
                    alt="Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-gray-900 dark:text-gray-100">
                        {{ $post->ownerOfPost->name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>

                <p class="mt-2 text-gray-800 dark:text-gray-200 leading-relaxed">
                    {{ $post->content }}
                </p>
                <div class="flex items-center gap-3 mt-4">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none transition">

                            Edit
                        </a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-400 focus:outline-none transition">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>

            </div>
        </div>
    </div>


    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-2xl p-5 space-y-5">


        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 border-b border-gray-200 dark:border-gray-700 pb-3">
            Comments ({{ $post->comments_count ?? 0 }})
        </h3>


        <div class="flex items-start gap-3">

            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                <img
                    src="{{ auth()->user()->avatar
                                ? asset('storage/images/avatars/' . auth()->user()->avatar)
                                : asset('default-avatar.png') }}"
                    alt="Avatar"
                    class="w-full h-full object-cover"
                >
            </div>

            <form class="flex-1" action="{{route('comments.store')}}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->id}}">
                <textarea
                    name="comment"
                    rows="2"
                    class="w-full p-3 rounded-xl border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Write a comment..."
                ></textarea>

                <div class="text-right mt-2">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>

        <div class="space-y-4 mt-6">

            @forelse($post->comments ?? [] as $comment)
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                        <img
                            src="{{ $comment->user->avatar
                                        ? asset('storage/images/avatars/' . $comment->user->avatar)
                                        : asset('default-avatar.png') }}"
                            alt="Avatar"
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <div class="flex-1 bg-gray-50 dark:bg-gray-900 rounded-xl p-3">
                        <div class="flex items-center justify-between">
                            <h4 class="font-semibold text-sm text-gray-900 dark:text-gray-100">
                                {{ $comment->user->name }}
                                @if($comment->user_id === $post->user_id)
                                    <span class="text-[11px] font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-800 px-2 py-0.5 rounded-full uppercase tracking-wide">
                                                 Owner
                                     </span>
                                @endif
                            </h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="mt-1 text-gray-800 dark:text-gray-200 text-sm">
                            {{ $comment->comment }}
                        </p>
                        <button
                            class="text-indigo-500 hover:underline mt-2 text-sm font-medium"
                            onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')">
                            Reply
                        </button>

                        <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                            <form method="POST" action="{{ route('reply.store') }}">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                        <img
                                            src="{{ auth()->user()->avatar
                                            ? asset('storage/images/avatars/' . auth()->user()->avatar)
                                            : asset('default-avatar.png') }}"
                                            alt="Avatar"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                    <div class="flex-1">
                            <textarea
                                name="reply_comment"
                                rows="2"
                                class="w-full p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 resize-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Write a reply..."
                            ></textarea>
                                        <div class="text-right mt-2">
                                            <button type="submit"
                                                    class="px-3 py-1 bg-indigo-600 text-white text-xs font-medium rounded-lg hover:bg-indigo-700 transition">
                                                Send Reply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if ($comment->replies->count())
                            <div class="ml-6 mt-4 space-y-3 border-l border-gray-200 dark:border-gray-700 pl-4">
                                @foreach ($comment->replies as $reply)
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                                            <img
                                                src="{{ $reply->user->avatar
                                                ? asset('storage/images/avatars/' . $reply->user->avatar)
                                                : asset('default-avatar.png') }}"
                                                alt="Avatar"
                                                class="w-full h-full object-cover"
                                            >
                                        </div>
                                        <div class="flex-1 bg-gray-100 dark:bg-gray-800 rounded-lg p-2">
                                            <div class="flex items-center justify-between">
                                                <h5 class="font-semibold text-xs text-gray-900 dark:text-gray-100">
                                                    {{ $reply->user->name }}
                                                    @if($reply->user_id === $post->user_id)
                                                        <span class="text-[11px] font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-100 dark:bg-indigo-800 px-2 py-0.5 rounded-full uppercase tracking-wide">
                                                                Owner
                                                        </span>
                                                    @endif

                                                </h5>
                                                <span class="text-[11px] text-gray-500 dark:text-gray-400">
                                        {{ $reply->created_at->diffForHumans() }}
                                    </span>
                                            </div>
                                            <p class="mt-1 text-gray-700 dark:text-gray-300 text-sm">
                                                {{ $reply->reply_comment }}
                                            </p>
                                            @can('update', $reply)
                                                <button
                                                    class="text-indigo-500 hover:underline mt-2 text-sm font-medium"
                                                    onclick="let el=document.getElementById('edit-form-{{ $reply->id }}'); el.classList.toggle('hidden'); el.querySelector('textarea').focus();">
                                                    Edit
                                                </button>

                                                <div id="edit-form-{{ $reply->id }}" class="hidden mt-3">
                                                    <form method="POST" action="{{ route('reply.update', $reply->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value="{{$comment->id}}" name="comment_id">
                                                        <textarea name="reply_comment" rows="2" class="w-full border rounded p-2">{{ $reply->reply_comment }}</textarea>
                                                        <div class="flex gap-2 mt-2">
                                                            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">Save</button>
                                                            <button type="button" class="px-4 py-1 rounded border" onclick="document.getElementById('edit-form-{{ $reply->id }}').classList.add('hidden')">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endcan
                                            @can('delete', $reply)
                                                <form method="POST" action="{{ route('reply.destroy', $reply->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this reply?')"
                                                            class="text-red-600 hover:underline text-sm font-medium">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan



                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @can('update', $comment)
                        <form action="{{ route('comments.edit', $comment->id) }}" method="GET" class="text-right mt-2">
                            <button type="submit"
                                    class="px-3 py-1 text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
                                Edit
                            </button>
                        </form>
                        @endcan
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="text-right mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this comment?')"
                                        class="px-3 py-1 text-xs font-medium text-red-600 dark:text-red-400 hover:underline">
                                    Delete
                                </button>
                            </form>
                        @endcan

                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 dark:text-gray-400">No comments yet.</p>
            @endforelse
        </div>

    </div>

</div>

</body>
</html>
