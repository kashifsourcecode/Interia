<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInfoCard extends Model
{
    protected $fillable = [
        'contact_section_id',
        'sort_order',
        'heading',
        'body',
        'icon_path',
    ];

    /**
     * @return BelongsTo<ContactSection, $this>
     */
    public function contactSection(): BelongsTo
    {
        return $this->belongsTo(ContactSection::class);
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
