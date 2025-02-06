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
            'relationships' => [
                'zone' => 'zone'
            ],
            'includes' => [
                'zone' => 'zones',
            ],
            'links' => [
                'self' => route('projects.show', ['project' => $this->id]),
            ],
        ];
    }
}
