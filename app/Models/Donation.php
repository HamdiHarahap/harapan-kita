<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function donator(): BelongsTo
    {
        return $this->belongsTo(Donator::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }


    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
