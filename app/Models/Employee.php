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
}
