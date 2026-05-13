<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IndustrySection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'description',
        'sub_heading',
        'sub_lead',
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

    /** @return HasMany<IndustryCard, $this> */
    public function cards(): HasMany
    {
        return $this->hasMany(IndustryCard::class)->orderBy('sort_order');
    }

    /**
     * @return Collection<int, IndustryCard>
     */
    public function cardsInColumn(string $column): Collection
    {
        return $this->cards()
            ->where('mosaic_column', $column)
            ->orderBy('sort_order')
            ->get();
    }
}
