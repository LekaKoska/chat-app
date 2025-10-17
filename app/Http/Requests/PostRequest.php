<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => 'required|min:3|string',
        ];
    }
}
