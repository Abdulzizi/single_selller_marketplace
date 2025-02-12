<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'product_category_id' => $this->category_id,
            'product_category_name' => isset($this->category) ? $this->category->name : "",
            'is_available' => (string) $this->is_available,
            'description' => $this->description,

            // (ambil photo desktop dan mobile)

            'photo_desktop_url' => !empty($this->photo_desktop) ? $this->photo_desktop : asset('assets/img/no-image.png'),
            'photo_mobile_url' => !empty($this->photo_mobile) ? $this->photo_mobile : asset('assets/img/no-image.png'),

            'details' => ProductDetailResource::collection($this->details),
        ];
    }
}
