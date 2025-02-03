<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory()->workerType(),

            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'company'         => $this->faker->randomElement(['DUBOCQ', 'ETAM']),
            'contract_hours'  => $this->faker->numberBetween(35,37,40),
            'monthly_salary'  => $this->faker->randomFloat(2, 1000, 3500),
        ];
    }
}
