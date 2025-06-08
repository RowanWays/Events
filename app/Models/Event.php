<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_date',
        'end_date',
        'price',
        'max_tickets',
        'available_tickets',
        'image',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getDateAttribute()
    {
        return $this->start_date;
    }

    public function getNameAttribute()
    {
        return $this->title;
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function getTicketsSoldAttribute(): int
    {
        return $this->tickets()->where('status', 'active')->count();
    }

    public function hasAvailableTickets(): bool
    {
        return $this->available_tickets > 0;
    }

    public function decrementAvailableTickets(int $amount = 1): void
    {
        $this->decrement('available_tickets', $amount);
    }
}
