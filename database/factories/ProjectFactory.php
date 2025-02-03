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
            // Génère un code à 6 caractères (lettres ou chiffres, puis mise en majuscules)
            'code' => strtoupper($this->faker->lexify('??????')),

            // Tire au hasard l'un des 3 types
            'type' => $this->faker->randomElement(['MH', 'GO', 'OTHER']),

            // Nom de projet : 2 mots
            'name' => $this->faker->words(2, true),

            // Adresse
            'address' => $this->faker->streetAddress,

            // Ville
            'city' => $this->faker->city,

            // Distance sur 2 décimales, entre 1 et 999.99
            'distance' => $this->faker->randomFloat(2, 1, 999.99),

            // Statut parmi ACTIVE ou INACTIVE
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),

            // Génère (ou référence) une zone aléatoire
            // -> pour que la contrainte foreign key zone_id fonctionne
            'zone_id' => Zone::inRandomOrder()->value('id'),
        ];
    }
}
