<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'full_name' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'password', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:255', 'unique:users,phone'],
            'telegram_chat_id' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'string', 'max:255'],
            'auth_code' => ['nullable', 'string', 'max:255'],
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'email_verified_at' => ['nullable', 'email', 'max:255'],
            'phone_verified_at' => ['nullable', 'string', 'max:255'],
            'blocked_at' => ['nullable', 'string', 'max:255'],
        ];
    }
}
