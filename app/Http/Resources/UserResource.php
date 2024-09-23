<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id_group' => $this->id_group,
            'email' => $this->email,
            'password' => $this->password,
            'customer_name' => $this->customer_name,
            'pic_name' => $this->pic_name,
            'pic_phone' => $this->pic_phone,
            'address' => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => new CompanyResource($this->company),
        ];
    }
}
