<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Users\UserResource;
use App\Services\Api\UserServices\UserProfileService;

class UserController extends Controller
{
    private $userProfileService;
    
    public function __construct(UserProfileService $userProfileService)
    {
        $this->middleware(['auth:api', 'verify']);
        $this->userProfileService = $userProfileService;
    }
    public function myProfile(){
        return $this->userProfileService->myProfile();
    }
}
