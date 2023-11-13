<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'domain' => $this->domain,
            'logo' => $this->logo,
            'vk_group' => $this->vk_group,
            'telegram_channel' => $this->telegram_channel,
            'description' => $this->description,
            'contacts' => $this->contacts,
            'socials' => $this->socials,
            'bots' => $this->bots,
            'banners' => $this->banners,
            'site_url' => $this->site_url,
            'is_active' => $this->is_active,
            'payment_card' => $this->payment_card,
            'work_time' => $this->work_time,
            'amo_link' => $this->amo_link,
            'amo_login' => $this->amo_login,
            'amo_password' => $this->amo_password,
            'deleted_at' => $this->deleted_at,
            'productCategories' => ProductCategoryCollection::make($this->whenLoaded('productCategories')),
            'orders' => OrderCollection::make($this->whenLoaded('orders')),
        ];
    }
}
