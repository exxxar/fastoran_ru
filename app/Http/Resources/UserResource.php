<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'telegram_chat_id' => $this->telegram_chat_id,
            'birthday' => $this->birthday,
            'auth_code' => $this->auth_code,
            'role_id' => $this->role_id,
            'email_verified_at' => $this->email_verified_at,
            'phone_verified_at' => $this->phone_verified_at,
            'blocked_at' => $this->blocked_at,
            'locations' => LocationCollection::make($this->whenLoaded('locations')),
        ];
    }
}
