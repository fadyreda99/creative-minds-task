<?php
namespace App\Services\Api\AuthServices;

use App\Models\User;
use App\Models\UserFcmToken;
use App\Models\UserImage;
use App\Models\UserLocation;
use App\Traits\VerificationCodeTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService{
    use VerificationCodeTrait;
    public function register($request){
        $code = $this->generateCode();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads/user/images/' . $request->username . '_' . time(), ['disk' => 'public']);
        }

        $role = 'user';
        if(isset($request->type) && $request->type == 'driver'){
            $role = 'driver';
        }

        $db_role = Role::where('name', $role)->first();

        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'verification_code' => $code
            ]);
            $user->assignRole($db_role);
            if($request->fcm_token) {
                $fcm = UserFcmToken::create([
                    'fcm_token' => $request->fcm_token,
                    'user_id' => $user->id
                ]);
            }
            $user_image = UserImage::create([
                'image' => $image,
                'user_id' => $user->id
            ]);

            $user_location = UserLocation::create([
                'lat' => $request->lat,
                'lang' => $request->lang,
                'user_id' => $user->id
            ]);

            DB::commit();
            $this->sendCode($code, $user->phone);
            $token = JWTAuth::fromUser($user);
            return $token;
            // return $this->respondWithToken($token);
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('daily')->info('register error'.$e->getMessage());
            // return $e->getMessage();
        }
    }
}