<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactSection extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'title',
        'subtitle',
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

    /** @return HasMany<ContactInfoCard, $this> */
    public function infoCards(): HasMany
    {
        return $this->hasMany(ContactInfoCard::class)->orderBy('sort_order');
    }
}
