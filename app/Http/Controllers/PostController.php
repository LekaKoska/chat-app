<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Traits\VoteTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    use AuthorizesRequests, VoteTrait;
    public function index(): View
    {
        $page = request('page', 1);
        $cacheKey = 'all_posts_page_' . $page;

        $posts = Cache::tags(['posts'])->remember($cacheKey, 300, fn() =>
        Post::with('ownerOfPost')
            ->withSum('votes as votes_score', 'vote')
            ->where('status', PostStatus::Published)
            ->latest()
            ->paginate(10)
        );
        if (auth()->check()) {
            $userId = auth()->id();
            $posts->getCollection()->load(['userVote' => function ($q) use ($userId) {
                $q->where('user_id', $userId);
            }]);
        }

        return view('posts.all', ['posts' => $posts]);
    }
    public function search(Request $request): View
    {
        $search = Str::slug($request->get('search'));
        $posts = Post::where('slug', 'LIKE', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view(view: "posts.all", data: compact('posts'));
    }
    public function create(): View
    {
        return view(view: 'posts.add');
    }
    public function store(PostRequest $request): RedirectResponse
    {
        $data = array_merge($request->validated(), ['user_id' => $request->user()->id]);
        Post::create($data);

        return redirect()->route('posts.index')->with(key: 'success', value: 'Your post is added, wait for moderator to confirm!');
    }
    public function show(Post $post): View
    {
        $post = Cache::tags(["post:{$post->id}"])->remember("post:{$post->id}", now()->addMinutes(10),
            fn() => $post->load('ownerOfPost',
                'comments.user',
                'comments.replies.user')->loadCount('comments'));
        $this->authorize(ability: 'view', arguments: $post);
        return view(view: 'posts.permalink', data: compact('post'));
    }
    public function edit(Post $post): View
    {
        $this->authorize(ability: 'update', arguments: $post);
        return view(view: 'posts.edit', data: compact('post'));
    }
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = array_merge($request->validated(), ['user_id' => $request->user()->id]);
        $post->update($data);
        return redirect()->route('posts.index');
    }
    public function upvote(Post $post): RedirectResponse
    {
        $this->voting(modelWithRelation: $post->votes(), column: 'post_id', value: 1);
        return redirect()->back();
    }
    public function downvote(Post $post): RedirectResponse
    {
        $this->voting(modelWithRelation: $post->votes(), column: 'post_id', value: -1);
        return redirect()->back();
    }
    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize(ability: 'delete', arguments: $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
    public function sort(Request $request): View
    {
        $sort = $request->get('sort', 'latest');

        $posts = Cache::tags(['posts'])->remember("post.sort.{$sort}", 300, function () use ($sort) {
            $query = Post::with(['ownerOfPost', 'currentUserVote'])
                ->where('status', PostStatus::Published)
                ->withCount('comments')
                ->withCount([
                    'votes as votes_count' => fn($q) => $q->where('vote', 1)
                ]);

            $query = match ($sort) {
                'likes' => $query->orderBy('votes_count', 'desc'),
                'comments' => $query->orderBy('comments_count', 'desc'),
                default => $query->latest(),
            };

            return $query->paginate(10)->withQueryString();
        });

        return view('posts.all', compact('posts'));
    }

}

