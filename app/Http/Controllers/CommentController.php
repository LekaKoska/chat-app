<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(CommentRequest $request)
    {
        Comment::create($request->validated() + ['user_id' => Auth::id()]);
        return redirect()->back()->with(key: 'success', value: 'You add new comment');
    }

    public function edit(Comment $comment): View
    {
       return view(view: 'comments.edit', data: compact('comment'));
    }

    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize(ability: 'update', arguments: $comment);
        $comment->update($request->validated());
        return redirect()->route(route: 'posts.show', parameters: $comment->post_id);
    }
    public function destroy(Comment $comment)
    {
        $this->authorize(ability: 'delete', arguments: $comment);
        $comment->delete();
        return redirect()->back();
    }
}
