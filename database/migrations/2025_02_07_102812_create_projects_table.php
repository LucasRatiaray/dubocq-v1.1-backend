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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->enum('project_type', ['mh', 'go', 'other']);
            $table->string('name', 255);
            $table->string('address', 255);
            $table->string('city', 255);
            $table->decimal('distance', 10, 2);
            $table->enum('status', ['active', 'inactive']);
            $table->foreignId('zone_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('employee_project', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->primary(['employee_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_project');
        Schema::dropIfExists('projects');
    }
};
