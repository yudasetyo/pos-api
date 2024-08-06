<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productName' => ['required', 'string', 'max:255'],
            'productImage' => ['sometimes', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
            'productDescription' => ['required', 'string', 'max:65535'],
            'productPrice' => ['required', 'integer'],
        ];
    }
}
