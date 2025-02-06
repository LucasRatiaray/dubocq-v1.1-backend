<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'project',
            'id' => $this->id,
            'attributes' => [
                'code' => $this->code,
                'type' => $this->type,
                'name' => $this->name,
                'address' => $this->address,
                'city' => $this->city,
                'status' => $this->status,
                $this->mergeWhen($request->routeIs('projects.show'), [
                    'distance' => $this->distance,
                    'zone_name' => $this->zone->name,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ]),
            ],
            $this->mergeWhen($request->routeIs('projects.show'), [
                'relationships' => [
                    'employees' =>
                    $this->employees->map(function ($employee) {
                        return [
                            'data' => [
                                'type' => 'employee',
                                'id'   => $employee->id,
                            ],
                            'links' => [
                                'self' => route('employees.show', ['employee' => $employee->id]),
                            ],
                        ];
                    }),
                ],
                'includes' => $this->employees->map(function ($employee) {
                    if ($employee->employable_type === 'App\Models\Worker') {
                        return new WorkerResource($employee->employable);
                    } elseif ($employee->employable_type === 'App\Models\Interim') {
                        return new InterimResource($employee->employable);
                    }
                }),
            ]),
            'links' => [
                'self' => route('projects.show', ['project' => $this->id]),
            ],
        ];
    }
}
