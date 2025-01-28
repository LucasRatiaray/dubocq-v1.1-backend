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
            'id' => $this->id,
            'attributes' => [
                'zone_name' => $this->zone_name,
                'min_km' => $this->min_km,
                'max_km' => $this->max_km,
                'rate' => $this->rate,
            ],
            'links' => [
                ['self' => route('zones.show', ['zone' => $this->id])]
            ]
        ];
    }
}
