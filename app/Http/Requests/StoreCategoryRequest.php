<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'category_name' => [
                'required',
                Rule::unique('categories', 'category_name')->ignore($id),
            ],
            'description' => 'required|max:100|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'category_name.required' => 'Nama kategori tidak boleh kosong',
            'category_name.unique' => 'Nama kategori sudah digunakan',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.min' => 'Deskripsi minimal 10 karakter',
            'description.max' => 'Deskripsi maksimal 100 karakter',
        ];
    }
}
