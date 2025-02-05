<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Worker;
use App\Models\Interim;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'employable_id' => null, // Défini plus tard dans le seeder
            'employable_type' => null, // Défini plus tard dans le seeder
        ];
    }

    /**
     * Associe un Worker ou un Interim à Employee
     */
    public function forEmployable($employable)
    {
        return $this->state([
            'employable_id' => $employable->id,
            'employable_type' => get_class($employable),
        ]);
    }
}
