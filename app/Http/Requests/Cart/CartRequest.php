<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public $validator;

    public function failedValidation($validator)
    {
        $this->validator = $validator;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        }

        return $this->updateRules();
    }

    private function createRules(): array
    {
        return [
            'user_id' => 'nullable|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'product_detail_id' => 'nullable|exists:product_details,id',
            'quantity' => 'required|integer|min:1',
        ];
    }

    private function updateRules(): array
    {
        return [
            'id' => 'required|exists:carts,id',
            'user_id' => 'nullable|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'product_detail_id' => 'nullable|exists:product_details,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
