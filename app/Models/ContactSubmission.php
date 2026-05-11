<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    public const STATUS_NEW = 'new';

    public const STATUS_READ = 'read';

    public const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'service',
        'message',
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
            $this->status = self::STATUS_READ;
            $this->read_at = now();
            $this->save();
        }
    }
}
