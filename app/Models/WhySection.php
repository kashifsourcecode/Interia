<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WhySection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'description',
        'hero_image_path',
        'hero_image_alt',
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

    /** @return HasMany<WhyFeature, $this> */
    public function features(): HasMany
    {
        return $this->hasMany(WhyFeature::class)->orderBy('sort_order');
    }

    public function resolvedHeroImageUrl(): string
    {
        $path = (string) $this->hero_image_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }
}
