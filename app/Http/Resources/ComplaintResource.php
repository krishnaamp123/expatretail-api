<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
            'complaint_date' => $this->complaint_date,
            'image' => $this->image,
            'production_code' => $this->production_code,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'customer' => new UserResource($this->customer),
        ];
    }
}
