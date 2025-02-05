<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Zone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'code' => strtoupper($this->faker->lexify('??????')),
             'type' => $this->faker->randomElement(['mh', 'go', 'autre']),
             'name' => $this->faker->words(2, true),
             'address' => $this->faker->streetAddress,
             'city' => $this->faker->city,
             'distance' => $this->faker->randomFloat(2, 1, 999.99),
             'status' => $this->faker->randomElement(['active', 'inactive']),
             'zone_id' => Zone::inRandomOrder()->value('id'),
        ];
    }
}
