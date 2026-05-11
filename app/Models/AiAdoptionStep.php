<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAdoptionStep extends Model
{
    protected $fillable = [
        'ai_adoption_section_id',
        'sort_order',
        'step_label',
        'title',
        'description',
        'style_key',
        'icon_path',
        'stat_emphasis',
        'stat_caption',
    ];

    /**
     * @return BelongsTo<AiAdoptionSection, $this>
     */
    public function aiAdoptionSection(): BelongsTo
    {
        return $this->belongsTo(AiAdoptionSection::class);
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
    public static function layoutStyleKeys(): array
    {
        return ['detect', 'analyze', 'automate', 'secure', 'optimize'];
    }

    public function layoutCssClass(): string
    {
        $key = (string) $this->style_key;

        return in_array($key, self::layoutStyleKeys(), true)
            ? 'ai-step--'.$key
            : 'ai-step--detect';
    }
}
