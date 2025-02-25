<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_name' => isset($this->user) ? $this->user->name : null,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // New Address Details
            'street'          => $this->street,
            'apartment'       => $this->apartment,
            'city'            => $this->city,
            'postcode'        => $this->postcode,
            'country'         => $this->country,

            // Payment Information
            'payment_method'  => $this->payment_method,
            'payment_details' => $this->payment_details,

            // Include order details
            'details' => OrderDetailResource::collection($this->details),
        ];
    }
}
