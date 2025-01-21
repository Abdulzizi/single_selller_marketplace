<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use ProtoneMedia\LaravelMixins\Request\ConvertsBase64ToFiles;

class ProductRequest extends FormRequest
{
    use ConvertsBase64ToFiles;
    public $validator;

    public function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        }

        return $this->updateRules();
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 150 karakter.',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka.',

            'photo_desktop.file' => 'Foto produk desktop harus berupa file yang valid.',
            'photo_desktop.image' => 'Foto produk desktop harus berupa gambar.',
            'photo_mobile.file' => 'Foto produk mobile harus berupa file yang valid.',
            'photo_mobile.image' => 'Foto produk mobile harus berupa gambar.',

            'is_available.required' => 'Ketersediaan produk wajib diisi.',
            'is_available.numeric' => 'Ketersediaan produk harus berupa angka.',
            'is_available.max' => 'Nilai ketersediaan produk tidak boleh lebih dari 1.',
            'product_category_id.required' => 'Kategori produk wajib diisi.',
            'details.*.type.required' => 'Tipe detail wajib diisi.',
            'details.*.description.required' => 'Deskripsi detail wajib diisi.',
            'details.*.price.numeric' => 'Harga detail harus berupa angka.',
            'details.*.id.exists' => 'ID detail tidak valid.',
        ];
    }


    private function createRules(): array
    {
        return [
            'name' => 'required|max:150',
            'price' => 'required|numeric',

            // Photo desktop dan mobile
            'photo_desktop' => 'nullable|file|image',
            'photo_mobile' => 'nullable|file|image',

            'is_available' => 'required|numeric|max:1',
            'product_category_id' => 'required',
            'details.*.type' => 'required',
            'details.*.description' => 'required',
            'details.*.price' => 'numeric',
        ];
    }

    private function updateRules(): array
    {
        return [
            'id' => 'required',
            'name' => 'required|max:150',
            'price' => 'required|numeric',

            // Photo desktop dan mobile
            'photo_desktop' => 'nullable|file|image',
            'photo_mobile' => 'nullable|file|image',

            'is_available' => 'required|numeric|max:1',
            'product_category_id' => 'required',
            'details.*.id' => 'nullable|exists:product_details,id',  // Id dari product_details
            'details.*.type' => 'required',
            'details.*.description' => 'required',
            'details.*.price' => 'numeric',
        ];
    }

    protected function base64FileKeys(): array
    {
        return [
            // Photo desktop dan mobile
            'photo_desktop' => 'nullable|file|image',
            'photo_mobile' => 'nullable|file|image',
        ];
    }

    public function attributes()
    {
        return [
            'is_available' => 'Status',
            'product_category_id' => 'Category'
        ];
    }
}
