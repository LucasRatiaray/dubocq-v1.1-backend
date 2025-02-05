<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Worker extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerFactory> */
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'status', 'contract_hours', 'monthly_salary'];

    /**
     * Get the employee record associated with the worker.
     */
    public function employee(): MorphOne
    {
        return $this->morphOne(Employee::class, 'employable');
    }
}
