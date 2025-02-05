<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = ['status', 'employable_id', 'employable_type'];

    /**
     * Get the parent employable model (interim or worker).
     */
    public function employable()
    {
        return $this->morphTo();
    }

    /**
     * Get the employee projects.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'employee_project');
    }
}
