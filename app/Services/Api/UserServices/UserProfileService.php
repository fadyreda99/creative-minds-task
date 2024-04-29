<?php
namespace App\Services\Api\UserServices;

use App\Http\Resources\Users\UserResource;

class UserProfileService{
    public function myProfile(){
        $user = auth()->user();

        return new UserResource($user);
    }
}