<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interim extends Model
{
    /** @use HasFactory<\Database\Factories\InterimFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'company',
        'hourly_rate',
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
