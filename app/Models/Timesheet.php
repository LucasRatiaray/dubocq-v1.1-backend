<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    /** @use HasFactory<\Database\Factories\TimesheetFactory> */
    use HasFactory;

    // $table->foreignId('employee_id')->constrained()->onDelete('cascade');
    // $table->foreignId('project_id')->constrained()->onDelete('cascade');
    // $table->foreignId('user_id');
    // $table->date('date');
    // $table->decimal('hours', 4, 2);
    // $table->enum('type', ['DAY', 'NIGHT']);
    // $table->timestamps();

    protected $fillable = [
        'employee_id',
        'project_id',
        'user_id',
        'date',
        'hours',
        'type',
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
