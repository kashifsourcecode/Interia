<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnterpriseQuoteRequest extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_CONTACTED = 'contacted';

    public const STATUS_QUOTED = 'quoted';

    public const STATUS_WON = 'won';

    public const STATUS_LOST = 'lost';

    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'job_title',
        'company',
        'website',
        'industry',
        'employee_count',
        'endpoint_count',
        'location_count',
        'current_it_setup',
        'cloud_platforms',
        'services_needed',
        'compliance_needs',
        'budget_range',
        'timeline',
        'preferred_contact',
        'details',
        'status',
        'ip_address',
        'user_agent',
        'read_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'cloud_platforms' => 'array',
            'services_needed' => 'array',
            'compliance_needs' => 'array',
            'read_at' => 'datetime',
        ];
    }

    public function fullName(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    public function markAsRead(): void
    {
        if ($this->status === self::STATUS_NEW) {
            $this->status = self::STATUS_CONTACTED;
            $this->read_at = now();
            $this->save();

            return;
        }

        if ($this->read_at === null) {
            $this->read_at = now();
            $this->save();
        }
    }
}
