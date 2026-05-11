<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceSection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'description',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /** @return HasMany<ServiceCarouselItem, $this> */
    public function carouselItems(): HasMany
    {
        return $this->hasMany(ServiceCarouselItem::class)->orderBy('sort_order');
    }

    /** @return HasMany<ServiceCard, $this> */
    public function cards(): HasMany
    {
        return $this->hasMany(ServiceCard::class)->orderBy('sort_order');
    }

    public static function forHome(): ?self
    {
        return static::query()
            ->where('slug', 'home')
            ->where('is_active', true)
            ->first();
    }
}
