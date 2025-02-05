<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Interim extends Model
{
    /** @use HasFactory<\Database\Factories\InterimFactory> */
    use HasFactory;

    protected $fillable = ['agency', 'hourly_rate'];

    /**
     * Get the employee record associated with the interim.
     */
    public function employee(): MorphOne
    {
        return $this->morphOne(Employee::class, 'employable');
    }
}
