<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'weight' => $this->weight,
            'price' => $this->price,
            'ingredient_category_id' => $this->ingredient_category_id,
            'product_id' => $this->product_id,
            'is_checked' => $this->is_checked,
            'is_disabled' => $this->is_disabled,
        ];
    }
}
