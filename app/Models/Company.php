<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'domain',
        'logo',
        'vk_group',
        'telegram_channel',
        'description',
        'contacts',
        'socials',
        'bots',
        'banners',
        'site_url',
        'is_active',
        'payment_card',
        'work_time',
        'amo_link',
        'amo_login',
        'amo_password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'contacts' => 'array',
        'socials' => 'array',
        'bots' => 'array',
        'banners' => 'array',
        'is_active' => 'boolean',
        'work_time' => 'array',
        'deleted_at' => 'timestamp',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function sections(): BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function seos(): BelongsToMany
    {
        return $this->belongsToMany(Seo::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function stories(): BelongsToMany
    {
        return $this->belongsToMany(Story::class);
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
