<?php
namespace App\Services\Api\AuthServices;

use App\Models\UserFcmToken;

class LoginService{
    public function login($credentials){
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'something wrong in credentials enter correct phone and password please'], 401);
        }

        $user = auth()->user();
        if (request('fcm_token')) {
            $fcm = UserFcmToken::create([
                'fcm_token' => request('fcm_token'),
                'user_id' => $user->id
            ]);
        }

        return $token;
    }
}