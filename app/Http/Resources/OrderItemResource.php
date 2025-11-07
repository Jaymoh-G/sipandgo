<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'product_id' => $this->product_id,
            'variant_id' => $this->variant_id,
            'quantity' => $this->quantity,
            'price' => (float) $this->price,
            'total' => (float) $this->total,
            'product' => $this->whenLoaded('product', function () {
                return new ProductResource($this->product);
            }),
            'variant' => $this->whenLoaded('variant', function () {
                return new ProductVariantResource($this->variant);
            }),
        ];
    }
}

