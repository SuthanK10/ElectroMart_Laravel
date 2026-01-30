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
            'total_amount' => $this->total_amount,
            'formatted_amount' => $this->formatted_amount,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'shipping_address' => $this->shipping_address,
            'contact_number' => $this->contact_number,
            'created_at' => $this->created_at->toDateTimeString(),
            'items' => $this->whenLoaded('items', function() {
                return $this->items->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'subtotal' => $item->price * $item->quantity,
                    ];
                });
            }),
        ];
    }
}
