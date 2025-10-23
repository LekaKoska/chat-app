<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\ReplyComment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class ReplyCommentController extends Controller
{
    use AuthorizesRequests;

    public function store(ReplyRequest $request): RedirectResponse
    {
       $data = array_merge($request->validated(), ['user_id' => auth()->id()]);
       ReplyComment::create($data);

       return redirect()->back();

    }

    public function update(ReplyRequest $request, ReplyComment $reply): RedirectResponse
    {
        $this->authorize(ability: 'update', arguments: $reply);
        $data = array_merge($request->all(), ['user_id' => auth()->id()]);
        $reply->update($data);
        return redirect()->back();
    }

    public function destroy(ReplyComment $reply): RedirectResponse
    {
       $this->authorize(ability: 'delete', arguments: $reply);
       $reply->delete();
       return redirect()->back();
    }
}
