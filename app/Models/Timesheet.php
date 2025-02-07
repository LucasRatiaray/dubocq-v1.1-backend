<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeSheet extends Model
{
    /** @use HasFactory<\Database\Factories\TimeSheetFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'working_time',
        'time_sheet_type',
        'employee_id',
        'project_id'
    ];

    protected $casts = [
        'date' => 'date',
        'working_time' => 'decimal:2'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
