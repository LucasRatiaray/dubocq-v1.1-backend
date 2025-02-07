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
        User::factory(1)->create();
        
        $this->call([
            SettingSeeder::class,
            ZoneSeeder::class,
            EmployeeSeeder::class,
            ProjectSeeder::class
        ]);
    }
}
