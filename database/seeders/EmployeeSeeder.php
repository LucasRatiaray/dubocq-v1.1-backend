<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Worker;
use App\Models\Interim;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Workers
        $workersData = [
            ['first_name' => 'Mounir', 'last_name' => 'AYEB', 'category' => 'worker', 'contract_hours' => 37, 'monthly_salary' => 2812.46],
            ['first_name' => 'Christophe', 'last_name' => 'FERNANDES', 'category' => 'etam', 'contract_hours' => 37, 'monthly_salary' => 4234.97]
        ];

        foreach ($workersData as $data) {
            $employee = Employee::create([
                'status' => 'active',
                'type' => 'worker'
            ]);
            Worker::create([
                'employee_id' => $employee->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'category' => $data['category'],
                'contract_hours' => $data['contract_hours'],
                'monthly_salary' => $data['monthly_salary']
            ]);
        }

        // Seed Interims
        $interimsData = [
            ['agency' => 'Manpower', 'hourly_rate' => 12.50],
            ['agency' => 'Adecco', 'hourly_rate' => 13.50]
        ];

        foreach ($interimsData as $data) {
            $employee = Employee::create([
                'status' => 'active',
                'type' => 'interim'
            ]);
            Interim::create([
                'employee_id' => $employee->id,
                'agency' => $data['agency'],
                'hourly_rate' => $data['hourly_rate']
            ]);
        }
    }
}
