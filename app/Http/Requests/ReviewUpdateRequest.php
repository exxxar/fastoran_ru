<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'text' => ['nullable', 'string'],
            'images' => ['nullable', 'json'],
            'rating' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'object_id' => ['required', 'integer', 'exists:objects,id'],
            'deleted_at' => ['nullable'],
        ];
    }
}
