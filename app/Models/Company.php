<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'email',
        'phone',
        'zipcode',
        'address',
        'house_number',
    ];


    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function socialMediaChannels()
    {
        return $this->morphMany(SocialMediaChannel::class, 'morphable');
    }
}
