<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => '',
            'email' => '',
            'subject' => 'required|max:255|min:3',
            'rating' => 'required',
            'description' => 'required|max:255|string',
            'product_id' => 'required|exists:products,id',
        ];
    }
}
