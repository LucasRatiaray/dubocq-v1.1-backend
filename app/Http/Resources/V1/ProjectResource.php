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
                'type'     => $this->when($request->routeIs('projects.show'), $this->type),
                'name'     => $this->name,
                'address'  => $this->when($request->routeIs('projects.show'), $this->address),
                'city'     => $this->city,
                'distance' => $this->when($request->routeIs('projects.show'), $this->distance),
                'status'   => $this->status,
                'zone'     => $this->zone->name,
            ],
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
            'links' => [
                ['self' => route('projects.show', ['project' => $this->id])],
            ],
        ];
    }
}
