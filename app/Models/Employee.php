<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'type',
        'status',
    ];

    public function worker(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Worker::class);
    }

    public function interim(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Interim::class);
    }

    public function getChildAttribute()
    {
        return $this->type === 'worker' ? $this->worker : $this->interim;
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function timesheets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    // protected $appends = ['hourly_rate', 'hourly_rate_charged'];

    // public function getHourlyRateAttribute()
    // {
    //     if ($this->contract_hours && $this->monthly_salary) {
    //         $monthlyHours = $this->contract_hours * (52 / 12);
    //         return round($this->monthly_salary / $monthlyHours, 2);
    //     }
    //     return null;
    // }

    // public function getHourlyRateChargedAttribute()
    // {
    //     $hourlyRate = $this->hourly_rate;
    //     if (! $hourlyRate) {
    //         return null;
    //     }

    //     $chargePercentage = (float) Setting::get('rate_charged', 70);

    //     $factor = 1 + ($chargePercentage / 100);

    //     return round($hourlyRate * $factor, 2);
    // }
}
