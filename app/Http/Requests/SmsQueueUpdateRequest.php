<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsQueueUpdateRequest extends FormRequest
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
            'phone' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
            'status' => ['required', 'integer'],
        ];
    }
}
