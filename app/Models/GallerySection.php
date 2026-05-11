<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class GallerySection extends Model
{
    protected $fillable = [
        'slug',
        'headline_line_1',
        'headline_line_2',
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

    /** @return HasMany<GalleryItem, $this> */
    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class);
    }

    /**
     * Mosaic slot order matches the original static markup / CSS layout.
     *
     * @return Collection<int, GalleryItem>
     */
    public function orderedGalleryItems(): Collection
    {
        $keys = GalleryItem::layoutSlotKeys();

        return $this->items
            ->sortBy(function (GalleryItem $item) use ($keys): int {
                $pos = array_search($item->shape_key, $keys, true);

                return $pos !== false ? $pos : PHP_INT_MAX;
            })
            ->values();
    }

    public static function layoutSlotKeys(): array
    {
        return GalleryItem::layoutSlotKeys();
    }
}
