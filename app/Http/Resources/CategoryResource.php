<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image' => $this->image,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'parent_id' => $this->parent_id,
            'products_count' => $this->when(isset($this->products_count), $this->products_count),
            'parent' => $this->whenLoaded('parent', function () {
                return new CategoryResource($this->parent);
            }),
            'children' => $this->whenLoaded('children', function () {
                return CategoryResource::collection($this->children);
            }),
            'products' => $this->whenLoaded('products', function () {
                return ProductResource::collection($this->products);
            }),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

