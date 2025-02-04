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
                'company'             => $this->company,
                'contract_hours'      => $this->contract_hours,
                'monthly_salary'      => $this->monthly_salary,
                'hourly_rate'         => $this->hourly_rate,
                'hourly_rate_charged' => $this->hourly_rate_charged,
            ],
            'relationships' => [
                'projects' => ['todo'],
            ],
            'links' => [
                ['self' => route('workers.show', ['worker' => $this->id])],
            ],
        ];
    }
}
