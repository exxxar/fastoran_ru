<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'company_id' => $this->company_id,
            'author_title' => $this->author_title,
            'lifetime' => $this->lifetime,
            'publish_at' => $this->publish_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
