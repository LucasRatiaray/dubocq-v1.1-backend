<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    // public static $wrap = 'employee'
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employee',
            'id' => $this->id,
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'status' => $this->employee_status,
                'contract_hours' => $this->contract_hours,
                'monthly_salary' => $this->monthly_salary,
                'hourly_rate' => $this->hourly_rate,
                'hourly_rate_charged' => $this->hourly_rate_charged
            ],
            'relationships' => [
                'project' => [
                    'data' => [
                        'type' => 'project',
                        'id' => 'todo'
                    ],
                    'links' => [
                        ['self' => 'todo']
                    ]
                ]
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ]
        ];
    }
}
