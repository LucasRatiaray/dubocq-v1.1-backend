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
                $this->mergeWhen($request->routeIs('employees.*'), [
                    'updated_at' => $this->when($request->routeIs('employees.*'), $this->updated_at),
                    'created_at' => $this->when($request->routeIs('employees.*'), $this->created_at),
                ]),
            ],
            'relationships' => [
                'worker' => $this->when($this->type === 'WORKER', function () {
                    return [
                        'data' => [
                            'type' => 'worker',
                            'id'   => $this->worker->id,
                        ],
                        'links' => [
                            ['self' => route('workers.show', ['worker' => $this->worker->id])]
                        ]
                    ];
                }),
                'interim' => $this->when($this->type === 'INTERIM', function () {
                    return [
                        'data' => [
                            'type' => 'interim',
                            'id'   => $this->interim->id,
                        ],
                        'links' => [
                            ['self' => route('interims.show', ['interim' => $this->interim->id])]
                        ]
                    ];
                }),
            ],
            'includes' => [
                $this->when($this->type === 'WORKER', new WorkerResource($this->worker)),
                $this->when($this->type === 'INTERIM', new InterimResource($this->interim)),
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ],
        ];
    }
}
