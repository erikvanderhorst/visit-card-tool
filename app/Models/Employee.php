<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'function',
        'email',
        'phone',
        'image',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function socialMediaChannels(): MorphMany
    {
        return $this->morphMany(SocialMediaChannel::class, 'morphable');
    }
}
