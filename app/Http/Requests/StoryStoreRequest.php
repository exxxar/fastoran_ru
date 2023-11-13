<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryStoreRequest extends FormRequest
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
            'image' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'author_title' => ['nullable', 'string', 'max:255'],
            'lifetime' => ['required', 'integer'],
            'publish_at' => ['nullable'],
            'deleted_at' => ['nullable'],
        ];
    }
}
