<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'employee_status' => fake()->randomElement(['salarié', 'etam']),
            'contract_hours' => fake()->randomElement([35, 37, 40]),
            'monthly_salary' => fake()->randomFloat(2, 0, 10000)
        ];
    }
}
