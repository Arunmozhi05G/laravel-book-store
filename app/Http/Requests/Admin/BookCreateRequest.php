<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['required', 'image', 'max:2048'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'author.required' => 'Author is required.',
            'description.required' => 'Description is required.',
            'category_id.required' => 'Category is required.',
            'image.required' => 'Image is required.',
            'image.image' => 'Image must be an image.',
            'image.max' => 'Image size should not exceed 2MB.',
            'price.required' => 'Price is required.',
            'quantity.required' => 'Quantity is required.',
        ];
    }
}
