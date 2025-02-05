<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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

    /**
     * Get the worker projects.
     */
    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(
            Project::class,
            Employee::class,
            'employable_id',
            'id',
            'id',
            'id'
        )->where('employees.employable_type', Worker::class);
    }
}
