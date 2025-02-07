<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    /** @use HasFactory<\Database\Factories\WorkerFactory> */
    use HasFactory;

    protected $table = 'workers';

    protected $fillable = [
        'first_name',
        'last_name',
        'category',
        'contract_hours',
        'monthly_salary'
    ];

    protected $casts = ['monthly_salary' => 'decimal:2'];
}
