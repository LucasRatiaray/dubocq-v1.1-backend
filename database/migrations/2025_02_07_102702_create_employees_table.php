<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['active', 'inactive']);
            $table->string('type')->nullable(); // 'worker' ou 'interim'
            $table->timestamps();
        });

        Schema::create('interims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('agency', 255);
            $table->decimal('hourly_rate', 10, 2);
            $table->timestamps();
        });

        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->enum('category', ['worker', 'etam']);
            $table->integer('contract_hours');
            $table->decimal('monthly_salary', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
        Schema::dropIfExists('interims');
        Schema::dropIfExists('employees');
    }
};
