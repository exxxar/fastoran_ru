<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:400'],
            'domain' => ['required', 'string', 'max:255', 'unique:companies,domain'],
            'logo' => ['nullable', 'string', 'max:400'],
            'vk_group' => ['nullable', 'string', 'max:255'],
            'telegram_channel' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'contacts' => ['nullable', 'json'],
            'socials' => ['nullable', 'json'],
            'bots' => ['nullable', 'json'],
            'banners' => ['nullable', 'json'],
            'site_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['required'],
            'payment_card' => ['nullable', 'string', 'max:255'],
            'work_time' => ['nullable', 'json'],
            'amo_link' => ['nullable', 'string', 'max:255'],
            'amo_login' => ['nullable', 'string', 'max:255'],
            'amo_password' => ['nullable', 'string', 'max:255'],
            'deleted_at' => ['nullable'],
        ];
    }
}
