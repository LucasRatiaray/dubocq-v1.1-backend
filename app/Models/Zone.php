<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Zone extends Model
{
    /** @use HasFactory<\Database\Factories\ZoneFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'min_km',
        'max_km',
        'rate'
    ];

    protected $casts = [
        'min_km' => 'decimal:2',
        'max_km' => 'decimal:2',
        'rate' => 'decimal:2'
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
