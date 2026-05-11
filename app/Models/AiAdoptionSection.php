<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AiAdoptionSection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'subtitle',
        'framework_heading',
        'framework_description',
        'dashboard_image_path',
        'dashboard_image_alt',
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

    /** @return HasMany<AiAdoptionStep, $this> */
    public function steps(): HasMany
    {
        return $this->hasMany(AiAdoptionStep::class)->orderBy('sort_order');
    }

    /** @return HasMany<AiAdoptionChecklistItem, $this> */
    public function checklistItems(): HasMany
    {
        return $this->hasMany(AiAdoptionChecklistItem::class)->orderBy('sort_order');
    }

    public function resolvedDashboardImageUrl(): string
    {
        $path = (string) $this->dashboard_image_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }
}
