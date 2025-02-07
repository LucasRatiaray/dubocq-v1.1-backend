<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Zone;
use App\Models\Employee;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zone = Zone::find(6);
        if (!$zone) {
            $zone = Zone::create([
                'name' => 'Default Zone',
                'min_km' => 0,
                'max_km' => 100,
                'rate' => 1.5
            ]);
        }

        $projects = [
            [
                'code' => 223014,
                'project_type' => 'mh', 
                'name' => 'Le Stephenson',
                'address' => '1 rue Stephenson',
                'city' => 'MONTIGNY-LE-BRETONNEUX',
                'distance' => 45.9,
                'status' => 'active',
                'zone_id' => $zone->id
            ]
        ];

        foreach ($projects as $project) {
            $project = Project::create($project);

            $this->assignEmployeesToProject($project);
        }
    }

    private function assignEmployeesToProject(Project $project)
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            $project->employees()->attach($employee->id);
        }

        $project->save();
    }
}
