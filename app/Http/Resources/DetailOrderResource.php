<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_cart' => $this->id_cart,
            'qty' => $this->qty,
            'price' => $this->price,
            'id_customer_product' => $this->id_customer_product,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'customer_product' => new CustomerProductResource($this->customerProduct),
        ];
    }
}
