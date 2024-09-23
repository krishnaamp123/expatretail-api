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
            'id_packaging' => $this->id_packaging,
            'product_name' => $this->product_name,
            'image' => $this->image,
            'descriprtion' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'packaging' => new PackagingResource($this->packaging),
        ];
    }
}
