<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeroStatItem extends Model
{
    protected $fillable = [
        'hero_section_id',
        'sort_order',
        'label',
        'count_target',
        'count_as_decimal',
        'suffix_after_count',
        'static_display',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'count_as_decimal' => 'boolean',
        ];
    }

    /**
     * @return BelongsTo<HeroSection, $this>
     */
    public function heroSection(): BelongsTo
    {
        return $this->belongsTo(HeroSection::class);
    }

    public function usesAnimatedCounter(): bool
    {
        return ! filled($this->static_display) && $this->count_target !== null;
    }
}
