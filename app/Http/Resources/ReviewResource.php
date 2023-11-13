<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'images' => $this->images,
            'rating' => $this->rating,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'object_id' => $this->object_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
