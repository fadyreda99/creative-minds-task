<?php

namespace App\Services\Admin\NotificationService;

use App\Models\UserFcmToken;
use App\Traits\NotificationTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PushNotificationService
{
    use NotificationTrait;
    public function push($request)
    {
        $tokens = UserFcmToken::all();
        $success = true;

        foreach ($tokens as $token) {
            try {
                $this->firebaseNotification($request->message, $token);
                Log::channel('daily')->info('notification yes');
            } catch (Exception $e) {
                Log::channel('daily')->info('error notification' . $e->getMessage());
                $success = false;
            }
        }

        if ($success == true) {
            return Redirect::route('admin.notify.index')->with('success', 'Notification Pushed successfully.');
        } else {
            return Redirect::route('admin.notify.index')->with('error', 'Notification not Pushed successfully.');
        }
    }
}
