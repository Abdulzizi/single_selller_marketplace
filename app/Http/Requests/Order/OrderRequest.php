<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
{
    public $validator;

    public function failedValidation(Validator $validator)
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

    public function messages(): array
    {
        return [
            // User id
            'user_id.required' => 'User ID is required.',
            'user_id.uuid' => 'User ID must be a valid UUID.',
            'user_id.exists' => 'User ID must exist in the users table.',

            // Details array
            'details.required' => 'Order details are required.',
            'details.array' => 'Order details must be an array.',

            // Details product_id
            'details.*.product_id.required' => 'Product ID is required for each order detail.',
            'details.*.product_id.uuid' => 'Product ID must be a valid UUID.',
            'details.*.product_id.exists' => 'Product ID must exist in the products table.',

            // Details quantity
            'details.*.quantity.required' => 'Quantity is required for each product.',
            'details.*.quantity.integer' => 'Quantity must be a valid integer.',
            'details.*.quantity.min' => 'Quantity must be at least 1.',
        ];
    }

    private function createRules(): array
    {
        return [
            'user_id' => 'required|uuid|exists:users,id',

            'details' => 'required|array',
            'details.*.product_id' => 'required|uuid|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
        ];
    }

    private function updateRules(): array
    {
        return [
            'id' => 'required|uuid|exists:orders,id',
            'user_id' => 'required|uuid|exists:users,id',

            'details' => 'nullable|array',
            'details.*.id' => 'nullable|exists:order_details,id', // Existing order detail ID
            'details.*.product_id' => 'required|uuid|exists:products,id',
            'details.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'User ID',
            'total_price' => 'Total Price',
            'status' => 'Order Status',
            'details' => 'Order Details',
        ];
    }
}
