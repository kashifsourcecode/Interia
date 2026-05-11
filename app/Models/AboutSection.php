<?php

namespace App\Models;

use App\Support\MediaUrl;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'intro_paragraph_1',
        'intro_paragraph_2',
        'mission_title',
        'mission_body',
        'vision_title',
        'vision_body',
        'footer_icon_path',
        'footer_emphasis',
        'footer_body',
        'hero_image_path',
        'hero_image_alt',
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

    public function resolvedHeroImageUrl(): string
    {
        $path = (string) $this->hero_image_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }

    public function resolvedFooterIconUrl(): string
    {
        $path = (string) $this->footer_icon_path;

        if ($path === '') {
            return '';
        }

        return MediaUrl::fromPath($path);
    }
}
