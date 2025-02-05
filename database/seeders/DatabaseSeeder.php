<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use App\Models\Worker;
use App\Models\Interim;
use App\Models\Project;
use App\Models\Zone;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(4)->create();

         // 1️⃣ Générer les Zones
         $this->call(ZoneSeeder::class);
         $zones = Zone::all();
 
         // 2️⃣ Définir le nombre total d'employés (ex: 20)
         $totalEmployees = 20;
 
         // 3️⃣ Créer les `Workers` et `Interims` en quantité égale à `Employees`
         $totalWorkers = (int) ($totalEmployees / 2);
         $totalInterims = $totalEmployees - $totalWorkers;
 
         $workers = Worker::factory()->count($totalWorkers)->create();
         $interims = Interim::factory()->count($totalInterims)->create();
 
         // 4️⃣ Créer exactement **1 Employee pour chaque Worker et Interim**
         $employees = collect();
 
         foreach ($workers as $worker) {
             $employees->push(Employee::factory()->forEmployable($worker)->create());
         }
 
         foreach ($interims as $interim) {
             $employees->push(Employee::factory()->forEmployable($interim)->create());
         }
 
         // 5️⃣ Générer les Projects et leur assigner une Zone aléatoire
         $projects = Project::factory()->count(10)->create([
             'zone_id' => $zones->random()->id,
         ]);
 
         // 6️⃣ Associer chaque Employee à 1 à 3 Projects aléatoires
         foreach ($employees as $employee) {
             $employee->projects()->attach(
                 $projects->random(rand(1, 3))->pluck('id')->toArray()
             );
         }
    }
}
