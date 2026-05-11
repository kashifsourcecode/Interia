<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OfferSection extends Model
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

    /** @return HasMany<OfferCard, $this> */
    public function cards(): HasMany
    {
        return $this->hasMany(OfferCard::class)->orderBy('sort_order');
    }
}
