<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

        $productId = $this->id ?? null;

        return [
            'id' => ['nullable', 'exists:products,id'],
            'product_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'product_name')->ignore($productId),
            ],
            'sku' => ['nullable', Rule::unique('products', 'sku')->ignore($this->id)],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'product_purchase_price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'numeric', 'min:0'],
            'minimum_stock' => ['required', 'numeric', 'min:0'],
            'category_id' => ['exists:categories,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'product_name.required' => 'Nama produk wajib diisi.',
            'product_name.string' => 'Nama produk harus berupa teks.',
            'product_name.max' => 'Nama produk maksimal 255 karakter.',
            'product_name.unique' => 'Nama produk sudah digunakan. Gunakan nama lain.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',
            'purchase_price.min' => 'Harga beli tidak boleh kurang dari 0.',

            'product_purchase_price.required' => 'Harga beli produk wajib diisi.',
            'product_purchase_price.numeric' => 'Harga beli produk harus berupa angka.',
            'product_purchase_price.min' => 'Harga beli produk tidak boleh kurang dari 0.',

            'stock.required' => 'Stok wajib diisi.',
            'stock.numeric' => 'Stok harus berupa angka.',
            'stock.min' => 'Stok tidak boleh kurang dari 0.',

            'minimum_stock.required' => 'Stok minimal wajib diisi.',
            'minimum_stock.numeric' => 'Stok minimal harus berupa angka.',
            'minimum_stock.min' => 'Stok minimal tidak boleh kurang dari 0.',

            'is_active.required' => 'Status aktif wajib diisi.',
            'is_active.boolean' => 'Status aktif harus bernilai benar atau salah.',

            'category_id.exists' => 'Kategori yang dipilih tidak valid.',
        ];
    }
}
