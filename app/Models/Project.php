<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = ['code', 'type', 'name', 'address', 'city', 'distance', 'status', 'zone_id'];

    /**
     * Get the project employees.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_project');
    }

    /**
     * Get the project zone.
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }
}
