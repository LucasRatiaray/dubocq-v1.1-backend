<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'first_name'        => $this->first_name,
                'last_name'         => $this->last_name,
                'email'             => $this->email,
                $this->mergeWhen($request->routeIs('users.*'), [
                    'email_verified_at' => $this->when($request->routeIs('users.*'), $this->email_verified_at),
                    'role'              => $this->when($request->routeIs('users.*'), $this->role),
                    'created_at'        => $this->when($request->routeIs('users.*'), $this->created_at),
                    'updated_at'        => $this->when($request->routeIs('users.*'), $this->updated_at),
                ]),
            ],
        ];
    }
}
