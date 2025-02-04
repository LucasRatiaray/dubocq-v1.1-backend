<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employee',
            'id'   => $this->id,
            'attributes' => [
                'type'       => $this->type,
                'status'     => $this->status,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'worker' => $this->when($this->type === 'WORKER', function () {
                    return new WorkerResource($this->worker);
                }),
                'interim' => $this->when($this->type === 'INTERIM', function () {
                    return new InterimResource($this->interim);
                }),
            ],
            'links' => [
                ['self' => route('employees.show', ['employee' => $this->id])]
            ],
        ];
    }
}


// 2) Rendre la ressource entière (optionnel)
// Si tu as déjà des WorkerResource ou InterimResource séparés, tu peux conditionner leur utilisation :

// php
// Copier
// Modifier
// 'relationships' => [
//     'worker' => $this->when($this->type === 'WORKER', function () {
//         return new WorkerResource($this->worker);
//     }),
//     'interim' => $this->when($this->type === 'INTERIM', function () {
//         return new InterimResource($this->interim);
//     }),
// ],