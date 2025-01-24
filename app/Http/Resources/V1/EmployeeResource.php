<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    // public static $wrap = 'employee'
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'employee',
            'id' => $this->id,
            'attributes' => [
                'first_name' => $this->firstname,
                'last_name' => $this->lastname,
                'status' => $this->employee_status,
            ]
        ];
    }
}
