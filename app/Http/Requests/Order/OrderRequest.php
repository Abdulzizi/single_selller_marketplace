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

            // Total price
            'total_price.required' => 'Total Price is required.',
            'total_price.numeric' => 'Total Price must be a number.',

            // Address fields
            'street.string' => 'Street must be a valid string.',
            'street.max' => 'Street must not exceed 255 characters.',
            'apartment.string' => 'Apartment must be a valid string.',
            'apartment.max' => 'Apartment must not exceed 255 characters.',
            'city.string' => 'City must be a valid string.',
            'city.max' => 'City must not exceed 255 characters.',
            'postcode.string' => 'Postcode must be a valid string.',
            'postcode.max' => 'Postcode must not exceed 20 characters.',
            'country.string' => 'Country must be a valid string.',
            'country.max' => 'Country must not exceed 255 characters.',

            // Payment fields
            'payment_method.string' => 'Payment method must be a valid string.',
            'payment_method.max' => 'Payment method must not exceed 255 characters.',
            'payment_details.array' => 'Payment details must be a valid array.',

            // Details array and its fields
            'details.required' => 'Order details are required.',
            'details.array' => 'Order details must be an array.',
            'details.*.product_id.required' => 'Product ID is required for each order detail.',
            'details.*.product_id.uuid' => 'Product ID must be a valid UUID.',
            'details.*.product_id.exists' => 'Product ID must exist in the products table.',
            'details.*.quantity.required' => 'Quantity is required for each product.',
            'details.*.quantity.integer' => 'Quantity must be an integer.',
            'details.*.quantity.min' => 'Quantity must be at least 1.',
        ];
    }

    private function createRules(): array
    {
        return [
            'user_id'           => 'required|uuid|exists:users,id',
            'total_price'       => 'required|numeric',
            'street'            => 'nullable|string|max:255',
            'apartment'         => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:20',
            'country'           => 'nullable|string|max:255',
            'payment_method'    => 'nullable|string|max:255',
            'payment_details'   => 'nullable|array',
            'details'           => 'required|array',
            'details.*.product_id' => 'required|uuid|exists:products,id',
            'details.*.quantity'   => 'required|integer|min:1',
        ];
    }

    private function updateRules(): array
    {
        return [
            'id'                => 'required|uuid|exists:orders,id',
            'user_id'           => 'required|uuid|exists:users,id',
            // When updating, total_price is calculated by the system, so it's optional here.
            'total_price'       => 'nullable|numeric',
            'street'            => 'nullable|string|max:255',
            'apartment'         => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:20',
            'country'           => 'nullable|string|max:255',
            'payment_method'    => 'nullable|string|max:255',
            'payment_details'   => 'nullable|array',
            'details'           => 'nullable|array',
            'details.*.id'      => 'nullable|exists:order_details,id', // For existing details 'details.*.product_id' => 'required_with:details|uuid|exists:products,id',
            'details.*.quantity'   => 'required_with:details|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id'           => 'User ID',
            'total_price'       => 'Total Price',
            'status'            => 'Order Status',
            'details'           => 'Order Details',
            'street'            => 'Street',
            'apartment'         => 'Apartment/Unit',
            'city'              => 'City',
            'postcode'          => 'Postcode',
            'country'           => 'Country',
            'payment_method'    => 'Payment Method',
            'payment_details'   => 'Payment Details',
        ];
    }
}
