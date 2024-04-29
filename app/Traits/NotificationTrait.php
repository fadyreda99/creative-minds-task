<?php

namespace App\Traits;

use App\Notifications\OrderReminder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Laravel\Firebase\Facades\Firebase;

trait NotificationTrait
{
    protected $notification;
    protected $data;
    protected $user;

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->notification = Firebase::messaging();
        
    // }


    public function firebaseNotification($message, $token)
    {

        //data message
        $notification = Firebase::messaging();
        $message = CloudMessage::fromArray([
            'token' => $token->fcm_token,
            'notification' => [
                'title' => 'notification',
                'body' => $message
            ],
        ]);
        $notification->send($message);

      
    }

  
}
