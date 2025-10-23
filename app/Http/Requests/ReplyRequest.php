<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment_id' => 'required|exists:comments,id',
            'reply_comment' => 'required|min:2'
        ];
    }
}
