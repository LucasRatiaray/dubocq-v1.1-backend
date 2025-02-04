<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'company',
        'contract_hours',
        'monthly_salary',
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
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
