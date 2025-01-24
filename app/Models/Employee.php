<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'employee_status',
        'contract_hours',
        'monthly_salary'
    ];

    protected $appends = ['hourly_rate', 'hourly_rate_charged'];

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

        $chargePercentage = (float) Setting::get('Taux Chargé', 70);

        $factor = 1 + ($chargePercentage / 100);

        return round($hourlyRate * $factor, 2);
    }
}
