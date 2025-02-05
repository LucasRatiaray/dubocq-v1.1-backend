<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InterimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'interim',
            'id'   => $this->id,
            'attributes' => [
                'agency'     => $this->agency,
                $this->mergeWhen($request->routeIs('interims.*'), [
                    'hourly_rate' => $this->hourly_rate,
                    'status'      => $this->employee->status,
                    'created_at' => $this->when($request->routeIs('interims.*'), $this->created_at),
                    'updated_at' => $this->when($request->routeIs('interims.*'), $this->updated_at),
                ]),
            ],
            'relationships' => [
                'employee' => 'project',
            ],
            'includes' => 'project',
            'links' => [
                'self' => route('interims.show', ['interim' => $this->id]),
            ],
        ];
    }
}
