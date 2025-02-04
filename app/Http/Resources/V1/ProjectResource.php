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
            'id'   => $this->id,
            'attributes' => [
                'code'     => $this->code,
                'name'     => $this->name,
                'city'     => $this->city,
                'status'   => $this->status,
                'zone'     => $this->zone->name,
                $this->mergeWhen($request->routeIs('projects.show'), [
                    'type'     => $this->type,
                    'address'  => $this->address,
                    'distance' => $this->distance,
                ]),
                $this->mergeWhen($request->routeIs('projects.*'), [
                    'created_at' => $this->when($request->routeIs('projects.*'), $this->created_at),
                    'updated_at' => $this->when($request->routeIs('projects.*'), $this->updated_at),
                ]),
            ],
            $this->mergeWhen($request->routeIs('projects.*'), [
                'relationships' => [
                    'zone' => [
                        'data' => [
                            'type' => 'zone',
                            'id'   => $this->zone->id,
                        ],
                        'links' => [
                            ['self' => route('zones.show', ['zone' => $this->zone->id])],
                        ],
                    ],
                ],
            ]),
            $this->mergeWhen(
                $request->routeIs('projects.*'),
                [
                    'includes' => [
                        new ZoneResource($this->zone),
                    ]
                ]
            ),
            'links' => [
                ['self' => route('projects.show', ['project' => $this->id])],
            ],
        ];
    }
}
