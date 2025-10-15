<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view(view: 'posts.all', data:
            [
                'posts' => Post::with(relations: 'ownerOfPosts')->where(column: 'status', operator: PostStatus::Published)->paginate(perPage: 10)
            ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
     return view(view: 'posts.add');
    }

    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     */
    public function store(PostRequest $request)
    {
        $this->authorize(ability: 'newPost', arguments: Post::class);
        Post::create($request->validated());

        return redirect()->route('posts.index')->with(key: 'success', value: 'Your post is added, wait for moderator to confirm!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
       return view(view: 'posts.permalink', data: compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
