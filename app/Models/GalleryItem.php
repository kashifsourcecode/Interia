<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    protected $fillable = [
        'gallery_section_id',
        'shape_key',
        'image_path',
        'image_alt',
        'tone_muted',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tone_muted' => 'boolean',
        ];
    }

    /**
     * Mosaic layout slots (matches CSS in resources/website/partials/head.blade.php).
     *
     * @return list<string>
     */
    public static function layoutSlotKeys(): array
    {
        return [
            'left-top',
            'left-bottom',
            'team',
            'desk',
            'office',
            'coffee',
            'window',
            'people',
            'meeting',
            'notes',
            'books',
            'laptop',
            'student',
            'culture',
        ];
    }

    /**
     * @return BelongsTo<GallerySection, $this>
     */
    public function gallerySection(): BelongsTo
    {
        return $this->belongsTo(GallerySection::class);
    }

    public function mosaicCssClasses(): string
    {
        $base = 'mosaic-card shape-'.$this->shape_key;

        if ($this->tone_muted) {
            $base .= ' tone-muted';
        }

        return $base;
    }

    public function resolvedImageUrl(): string
    {
        return MediaUrl::fromPath((string) $this->image_path);
    }
}
