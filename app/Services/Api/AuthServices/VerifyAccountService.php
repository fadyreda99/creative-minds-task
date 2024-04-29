<?php
namespace App\Services\Api\AuthServices;

use App\Models\User;

class VerifyAccountService{
    public function verifyAccount($request){
        $phone = $request->phone;
        $code = $request->code;
        $user = User::where('phone', $phone)->first();
        if ($user && strval($code) === $user->verification_code) {
            $user->verification_code = null;
            $user->account_verified_at = now();
            $user->save();
            return response()->json(['success' => 'verification successfully'], 200);
        } else {
            return response()->json(['errors' => ['code' => 'Code is wrong. Please try again!']], 400);
        }
    }
}