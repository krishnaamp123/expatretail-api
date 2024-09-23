<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerProductResource extends JsonResource
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
            'id_customer' => $this->id_customer,
            'id_product' => $this->id_product,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'customer' => new UserResource($this->customer),
            'product' => new ProductResource($this->product),
        ];
    }
}
