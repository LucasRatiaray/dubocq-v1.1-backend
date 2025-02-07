<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interim extends Model
{
    /** @use HasFactory<\Database\Factories\InterimFactory> */
    use HasFactory;

    protected $table = 'interims';

    protected $fillable = ['agency', 'hourly_rate'];

    protected $casts = ['hourly_rate' => 'decimal:2'];
}
