<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhyFeature extends Model
{
    protected $fillable = [
        'why_section_id',
        'sort_order',
        'title',
        'description',
        'icon_path',
    ];

    /**
     * @return BelongsTo<WhySection, $this>
     */
    public function whySection(): BelongsTo
    {
        return $this->belongsTo(WhySection::class);
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
