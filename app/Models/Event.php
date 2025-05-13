<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the user who created the event
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the registrations for the event
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    /**
     * Get the users registered for the event
     */
    public function attendees()
    {
        return $this->belongsToMany(User::class, 'registrations')
            ->withPivot('registered_at')
            ->withTimestamps();
    }

    /**
     * Check if the event has already happened
     */
    public function isPast(): bool
    {
        return $this->end_time < now();
    }

    /**
     * Check if the event is currently happening
     */
    public function isHappening(): bool
    {
        return $this->start_time <= now() && $this->end_time >= now();
    }

    /**
     * Check if the event is in the future
     */
    public function isFuture(): bool
    {
        return $this->start_time > now();
    }
}
