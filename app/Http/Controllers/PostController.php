<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Intervention\Image\Colors\Rgb\Channels\Red;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index(): View
    {
        return view(view: 'posts.all', data:
            [
                'posts' => Post::with(relations: 'ownerOfPosts')->where(column: 'status', operator: PostStatus::Published)->latest()->paginate(perPage: 10)
            ] );
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
    public function destroy(Post $post)
    {
        //
    }
}
