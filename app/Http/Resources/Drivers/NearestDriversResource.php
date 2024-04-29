<?php

namespace App\Http\Resources\Drivers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NearestDriversResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'phone' => $this['phone'],
            'email' => $this['email'],
            'name' => $this['name'],
            'dist' => $this['dist'] . ' km',
        ];
    }
}
