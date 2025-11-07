<?php

namespace App\Http\Resources;

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
            'order_number' => $this->order_number,
            'status' => $this->status,
            'subtotal' => (float) $this->subtotal,
            'tax' => (float) $this->tax,
            'shipping' => (float) $this->shipping,
            'total' => (float) $this->total,
            'shipping_address' => $this->shipping_address,
            'billing_address' => $this->billing_address,
            'items' => $this->whenLoaded('items', function () {
                return OrderItemResource::collection($this->items);
            }),
            'payment' => $this->whenLoaded('payment', function () {
                return new PaymentResource($this->payment);
            }),
            'customer' => $this->whenLoaded('customer', function () {
                return new CustomerResource($this->customer);
            }),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}

