<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'comment' => ['required', 'min:2', 'string']]
            + ($this->isMethod(method: 'POST') ? ['post_id' => ['required', 'integer', 'exists:posts,id']] : []);
    }
}
