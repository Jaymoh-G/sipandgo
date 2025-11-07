<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'description' => $this->description,
            'short_description' => $this->short_description,
            'sku' => $this->sku,
            'price' => (float) $this->price,
            'compare_price' => $this->compare_price ? (float) $this->compare_price : null,
            'cost_price' => $this->cost_price ? (float) $this->cost_price : null,
            'brand' => $this->brand,
            'alcohol_content' => $this->alcohol_content,
            'volume' => $this->volume,
            'origin_country' => $this->origin_country,
            'min_age' => $this->min_age,
            'requires_age_verification' => $this->requires_age_verification,
            'is_taxable' => $this->is_taxable,
            'weight' => $this->weight ? (float) $this->weight : null,
            'dimensions' => $this->dimensions,
            'images' => $this->images ?? [],
            'attributes' => $this->attributes ?? [],
            'is_active' => $this->is_active,
            'is_featured' => $this->is_featured,
            'track_inventory' => $this->track_inventory,
            'sort_order' => $this->sort_order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_on_sale' => $this->is_on_sale,
            'discount_percentage' => $this->discount_percentage,
            'primary_image_url' => $this->primary_image_url,
            'formatted_price' => $this->formatted_price,
            'category' => $this->whenLoaded('category', function () {
                return new CategoryResource($this->category);
            }),
            'variants' => $this->whenLoaded('variants', function () {
                return ProductVariantResource::collection($this->variants);
            }),
            'inventory' => $this->whenLoaded('inventory', function () {
                return InventoryResource::collection($this->inventory);
            }),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

