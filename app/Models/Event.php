<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'start_at', 'end_at', 'location'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
