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
                'status'     => $this->status,
                'employable_type' => class_basename($this->employable_type),
                $this->mergeWhen($request->routeIs('employees.*'), [
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ])
            ],
            'relationships' => [
                $this->mergeWhen($this->employable_type === 'App\Models\Worker', [
                    'worker' => [
                        'data' => [
                            'type' => 'worker',
                            'id'   => $this->employable->id,
                        ],
                        'links' => [
                            'self' => route('workers.show', ['worker' => $this->employable->id])
                        ]
                    ]
                ]),
                $this->mergeWhen($this->employable_type === 'App\Models\Interim', [
                    'interim' => [
                        'data' => [
                            'type' => 'interim',
                            'id'   => $this->employable->id,
                        ],
                        'links' => [
                            'self' => route('interims.show', ['interim' => $this->employable->id])
                        ]
                    ]
                ]),
            ],
            'includes' => [
                $this->mergeWhen($this->employable_type === 'App\Models\Worker', [
                    new WorkerResource($this->employable),
                ]),
                $this->mergeWhen($this->employable_type === 'App\Models\Interim', [
                    new InterimResource($this->employable),
                ]),
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ]
        ];
    }
}
