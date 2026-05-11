<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCarouselItem extends Model
{
    protected $fillable = [
        'service_section_id',
        'sort_order',
        'image_path',
        'caption',
        'image_alt',
    ];

    /**
     * @return BelongsTo<ServiceSection, $this>
     */
    public function serviceSection(): BelongsTo
    {
        return $this->belongsTo(ServiceSection::class);
    }

    public function resolvedImageUrl(): string
    {
        return MediaUrl::fromPath((string) $this->image_path);
    }
}
