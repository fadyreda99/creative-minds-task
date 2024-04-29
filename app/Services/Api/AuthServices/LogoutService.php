<?php

namespace App\Services\Api\AuthServices;

class LogoutService
{
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
