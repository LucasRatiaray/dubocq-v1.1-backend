<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employee',
            'id'   => $this->id,
            'attributes' => [
                'type'       => $this->type,
                'status'     => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'worker' => $this->when(
                    $this->type === 'WORKER',
                    function () {
                        return [
                            'data' => [
                                'type' => 'worker',
                                'id' => $this->worker?->id,
                                'first_name' => $this->worker?->first_name,
                                'last_name' => $this->worker?->last_name,
                                'company' => $this->worker?->company,
                                'contract_hours' => $this->worker?->contract_hours,
                                'monthly_salary' => $this->worker?->monthly_salary,
                                'hourly_rate' => $this->worker?->hourly_rate,
                                'hourly_rate_charged' => $this->worker?->hourly_rate_charged,
                            ],
                            'links' => [
                                ['self' => 'todo'],
                            ],
                        ];
                    }
                ),
                'interim' => $this->when(
                    $this->type === 'INTERIM',
                    function () {
                        return [
                            'data' => [
                                'type' => 'interim',
                                'id' => $this->interim?->id,
                                'company' => $this->interim?->company,
                                'hourly_rate' => $this->interim?->hourly_rate,
                            ],
                            'links' => [
                                ['self' => 'todo'],
                            ],
                        ];
                    }
                ),
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ],
        ];
    }
}


// 2) Rendre la ressource entière (optionnel)
// Si tu as déjà des WorkerResource ou InterimResource séparés, tu peux conditionner leur utilisation :

// php
// Copier
// Modifier
// 'relationships' => [
//     'worker' => $this->when($this->type === 'WORKER', function () {
//         return new WorkerResource($this->worker);
//     }),
//     'interim' => $this->when($this->type === 'INTERIM', function () {
//         return new InterimResource($this->interim);
//     }),
// ],