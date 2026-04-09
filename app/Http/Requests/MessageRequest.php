<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'required|min:1'
        ];
    }
}
