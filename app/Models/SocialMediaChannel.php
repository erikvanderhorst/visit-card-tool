<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SocialMediaChannel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'logo',
    ];

    public function morphable(): MorphTo
    {
        return $this->morphTo();
    }
}
