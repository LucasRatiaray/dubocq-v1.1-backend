<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Interim;
use App\Models\Project;
use App\Models\Worker;
use App\Models\Employee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingSeeder::class);
        $this->call(ZoneSeeder::class);
        User::factory(10)->create();
        Worker::factory()->count(12)->create();
        Interim::factory()->count(8)->create();
        $projects = Project::factory()->count(20)->create();

        $employees = Employee::all();

        foreach ($employees as $employee) {
            // On prend un subset de projets au hasard
            $subset = $projects->random(rand(1, $projects->count()));

            // On "attach" les IDs de projets à l'employé dans la table pivot
            $employee->projects()->attach($subset->pluck('id'));
        }

        $users = User::where('role', 'DRIVER')->get();

        foreach ($users as $user) {
            // Choix aléatoire de projets
            $subset = $projects->random(rand(1, $projects->count()));
            // Attach
            $user->projects()->attach($subset->pluck('id'));
        }
    }
}
