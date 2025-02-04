<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'zone',
            'id'   => $this->id,
            'attributes' => [
                'name'   => $this->name,
                'min_km' => $this->min_km,
                'max_km' => $this->max_km,
                $this->mergeWhen($request->routeIs('zones.*'), [
                    'rate'   => $this->rate,
                    'created_at' => $this->when($request->routeIs('zones.*'), $this->created_at),
                    'updated_at' => $this->when($request->routeIs('zones.*'), $this->updated_at),
                ]),
            ],
            $this->mergeWhen($request->routeIs('zones.*'), [
                'relationships' => [
                    'projects' => [
                        'data' =>
                        $this->projects->map(function ($project) {
                            return [
                                'type' => 'project',
                                'id'   => $project->id,
                            ];
                        }),
                    ]
                ],
            ]),
            $this->mergeWhen($request->routeIs('zones.*'), [
                'includes' => [
                    $this->projects->map(function ($project) {
                        return new ProjectResource($project);
                    }),
                ],
            ]),
            'links' => [
                'self' => route('zones.show', ['zone' => $this->id]),
            ],
        ];
    }
}
