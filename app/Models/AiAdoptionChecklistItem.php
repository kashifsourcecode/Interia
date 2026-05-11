<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiAdoptionChecklistItem extends Model
{
    protected $fillable = [
        'ai_adoption_section_id',
        'sort_order',
        'label',
    ];

    /**
     * @return BelongsTo<AiAdoptionSection, $this>
     */
    public function aiAdoptionSection(): BelongsTo
    {
        return $this->belongsTo(AiAdoptionSection::class);
    }
}
