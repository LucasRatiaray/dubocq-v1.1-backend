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
                'comapny'     => $this->company,
                'hourly_rate' => $this->hourly_rate,
            ],
            'relationships' => [
                'projects' => ['todo'],
            ],
            'links' => [
                ['self' => route('interims.show', ['interim' => $this->id])],
            ],
        ];
    }
}
