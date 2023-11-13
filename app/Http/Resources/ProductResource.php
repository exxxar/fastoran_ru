<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'images' => $this->images,
            'type' => $this->type,
            'status' => $this->status,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'in_stop_list' => $this->in_stop_list,
            'company_id' => $this->company_id,
            'productCategories' => ProductCategoryCollection::make($this->whenLoaded('productCategories')),
        ];
    }
}
