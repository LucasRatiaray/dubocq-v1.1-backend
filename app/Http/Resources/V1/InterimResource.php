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
                'company'     => $this->company,
                'hourly_rate' => $this->hourly_rate,
            ],
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
            'links' => [
                'self' => route('interims.show', ['interim' => $this->id]),
            ],
        ];
    }
}
