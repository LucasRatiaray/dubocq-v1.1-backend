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

    protected $fillable = ['first_name', 'last_name', 'category', 'contract_hours', 'monthly_salary'];

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

    public function getHourlyRateAttribute()
    {
        if ($this->contract_hours && $this->monthly_salary) {
            $monthlyHours = $this->contract_hours * (52 / 12);
            return round($this->monthly_salary / $monthlyHours, 2);
        }
        return null;
    }

    public function getHourlyRateChargedAttribute()
    {
        $hourlyRate = $this->hourly_rate;
        if (! $hourlyRate) {
            return null;
        }

        $chargePercentage = (float) Setting::get('rate_charged', 70);

        $factor = 1 + ($chargePercentage / 100);

        return round($hourlyRate * $factor, 2);
    }
}
