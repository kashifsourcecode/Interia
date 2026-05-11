<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PricingSection extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'addons_title',
        'addons_subtitle',
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

    /** @return HasMany<PricingPlan, $this> */
    public function plans(): HasMany
    {
        return $this->hasMany(PricingPlan::class)->orderBy('sort_order');
    }

    /** @return HasMany<PricingAddonCard, $this> */
    public function addonCards(): HasMany
    {
        return $this->hasMany(PricingAddonCard::class)->orderBy('sort_order');
    }
}
