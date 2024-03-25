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
            'Product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'section_id' => 'required|exists:sections,id',
        ];
    }

    public function messages()
    {
        return [
            'Product_name.required' => 'يرجى إدخال اسم المنتج',
            'Product_name.max' => 'يجب ألا يتجاوز اسم المنتج 255 حرفًا',
            'section_id.required' => 'يرجى اختيار القسم',
            'section_id.exists' => 'القسم المختار غير صحيح',
        ];
    }
}