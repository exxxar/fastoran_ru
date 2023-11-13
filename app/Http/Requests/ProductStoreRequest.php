<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'images' => ['nullable', 'json'],
            'type' => ['required', 'integer'],
            'status' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'discount_price' => ['required', 'numeric'],
            'in_stop_list' => ['required'],
            'company_id' => ['required', 'integer', 'exists:companies,id'],
        ];
    }
}
