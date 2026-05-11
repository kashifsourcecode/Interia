<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OfferCard extends Model
{
    protected $fillable = [
        'offer_section_id',
        'sort_order',
        'pill_label',
        'title',
        'description',
        'icon_path',
        'cta_label',
        'cta_url',
        'theme',
    ];

    /**
     * @return BelongsTo<OfferSection, $this>
     */
    public function offerSection(): BelongsTo
    {
        return $this->belongsTo(OfferSection::class);
    }

    public function resolvedIconUrl(): string
    {
        $path = (string) $this->icon_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    /**
     * @return list<string>
     */
    public static function themeKeys(): array
    {
        return ['gold', 'blue'];
    }

    public function cardCssClass(): string
    {
        $t = (string) $this->theme;

        return in_array($t, self::themeKeys(), true) ? $t : 'gold';
    }

    public function tagCssClass(): string
    {
        return $this->cardCssClass().'-tag';
    }

    public function buttonCssClass(): string
    {
        return $this->cardCssClass() === 'blue' ? 'btn-secondary' : 'btn-primary';
    }
}
