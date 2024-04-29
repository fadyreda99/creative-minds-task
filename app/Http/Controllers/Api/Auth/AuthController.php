<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerfyAccountRequest;
use App\Models\User;
use App\Models\UserFcmToken;
use App\Models\UserImage;
use App\Models\UserLocation;
use App\Services\Api\AuthServices\LoginService;
use App\Services\Api\AuthServices\LogoutService;
use App\Services\Api\AuthServices\RegisterService;
use App\Services\Api\AuthServices\VerifyAccountService;
use App\Traits\VerificationCodeTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use VerificationCodeTrait;

    private $loginService;
    private $logoutService;
    private $registerService;
    private $verifyAccountService;

    public function __construct(
        LoginService $loginService,
        LogoutService $logoutService,
        RegisterService $registerService,
        VerifyAccountService $verifyAccountService
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'verfiyAccount']]);

        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
        $this->registerService = $registerService;
        $this->verifyAccountService = $verifyAccountService;
    }


    public function register(RegisterRequest $request)
    {
        $token = $this->registerService->register($request);
        return $this->respondWithToken($token);
    }

    public function verfiyAccount(VerfyAccountRequest $request)
    {
        return $this->verifyAccountService->verifyAccount($request);
    }

    public function login()
    {
        $credentials = request(['phone', 'password']);
        $token = $this->loginService->login($credentials);
        return $this->respondWithToken($token);
    }


    public function logout()
    {
        return $this->logoutService->logout();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}
