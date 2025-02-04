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
                'worker' => $this->when($this->type === 'WORKER', function () {
                    return [
                        'data' => [
                            'type' => 'worker', 'id'   => $this->worker->id,
                        ],
                        'links' => [
                            ['self' => route('workers.show', ['worker' => $this->worker->id])]
                        ]
                    ];
                }),
                'interim' => $this->when($this->type === 'INTERIM', function () {
                    return [
                        'data' => [
                            'type' => 'interim', 'id'   => $this->interim->id,
                        ],
                        'links' => [
                            ['self' => route('interims.show', ['interim' => $this->interim->id])]
                        ]
                    ];
                }),
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ],
        ];
    }
}
