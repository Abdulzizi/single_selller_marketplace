<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\Product\ProductDetailResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_detail_id' => $this->product_detail_id,
            'quantity' => $this->quantity,
            // 'user' => new UserResource($this->whenLoaded('user')),
            'product_detail' => new ProductDetailResource($this->whenLoaded('productDetail')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
