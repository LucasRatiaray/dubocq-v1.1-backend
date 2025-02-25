<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'worker',
            'id'   => $this->id,
            'attributes' => [
                'first_name'          => $this->first_name,
                'last_name'           => $this->last_name,
                $this->mergeWhen($request->routeIs('workers.show'), [
                    'monthly_salary'      => $this->monthly_salary,
                    'hourly_rate'         => $this->hourly_rate,
                    'hourly_rate_charged' => $this->hourly_rate_charged,
                ]),
                $this->mergeWhen($request->routeIs('workers.*'), [
                    'company'             => $this->company,
                    'contract_hours'      => $this->contract_hours,
                    'status'              => $this->employee->status,
                    'created_at'          => $this->when($request->routeIs('workers.*'), $this->created_at),
                    'updated_at'          => $this->when($request->routeIs('workers.*'), $this->updated_at),
                ]),
            ],
            $this->mergeWhen($request->routeIs('workers.*'), [
                'relationships' => [
                    'projects' => [
                        'data' =>
                        $this->employee->projects->map(function ($project) {
                            return [
                                'type' => 'project',
                                'id'   => $project->id,
                            ];
                        }),
                    ]
                ],
            ]),
            $this->mergeWhen($request->routeIs('workers.*'), [
                'includes' => [
                    $this->employee->projects->map(function ($project) {
                        return new ProjectResource($project);
                    }),
                ],
                'links' => [
                    ['self' => route('workers.show', ['worker' => $this->id])],
                ],
            ]),
        ];
    }
}
