<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'region' => $this->region,
            'city' => $this->city,
            'district' => $this->district,
            'address' => $this->address,
            'landmark' => $this->landmark,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'object_type' => $this->object_type,
            'object_id' => $this->object_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
