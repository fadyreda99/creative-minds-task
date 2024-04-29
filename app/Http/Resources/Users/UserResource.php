<?php

namespace App\Http\Resources\Users;

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
            'id'=>$this->id,
            'username'=>$this->username,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'image'=>new UserImageResource($this->image),
            'location'=>new UserLocationResource($this->location)
        ];
    }
}
