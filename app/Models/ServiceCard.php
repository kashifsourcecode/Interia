<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCard extends Model
{
    protected $fillable = [
        'service_section_id',
        'sort_order',
        'name',
        'description',
        'cta_label',
        'cta_url',
        'icon_path',
    ];

    /**
     * @return BelongsTo<ServiceSection, $this>
     */
    public function serviceSection(): BelongsTo
    {
        return $this->belongsTo(ServiceSection::class);
    }

    public function resolvedIconUrl(): string
    {
        $path = (string) $this->icon_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }
}
