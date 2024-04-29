<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

trait VerificationCodeTrait
{

    public function generateCode()
    {
        $verificationCode = mt_rand(100000, 999999);
        return $verificationCode;
    }

    public function sendCode($code, $number)
    {
        try {

            $message = "Your Verfication Code Is. " . $code;
            $acc_sid = getenv('TWILIO_SID');
            $auth_token = getenv('TWILIO_TOKEN');
            $twilio_number = getenv('TWILIO_FROM');
            $to = '+2' . $number;

            $client = new Client($acc_sid, $auth_token);
            $client->messages->create($to, [
                'from' => $twilio_number,
                'body' => $message
            ]);
        } catch (Exception $e) {
            Log::channel('daily')->info('something wrong during sending verfication code');
            Log::channel('daily')->info($e->getMessage());
            return $e->getMessage();
        }
    }
}
