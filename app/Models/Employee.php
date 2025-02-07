<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = ['status'];

    public function getType(): ?Model
    {
        if ($this->type === 'worker') {
            return $this->worker;
        } elseif ($this->type === 'interim') {
            return $this->interim;
        }
        return null;
    }

    public function worker()
    {
        return $this->hasOne(Worker::class, 'employee_id');
    }

    public function interim()
    {
        return $this->hasOne(Interim::class, 'employee_id');
    }

    public function timeSheets(): HasMany
    {
        return $this->hasMany(TimeSheet::class);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }
}
