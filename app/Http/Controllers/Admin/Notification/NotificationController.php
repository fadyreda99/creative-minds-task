<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use App\Services\Admin\NotificationService\IndexService;
use App\Services\Admin\NotificationService\PushNotificationService;
use Illuminate\Http\Request;


class NotificationController extends Controller
{

    private $indexService;
    private $pushNotificationService;
    public function __construct(IndexService $indexService, PushNotificationService $pushNotificationService)
    {
        $this->indexService = $indexService;
        $this->pushNotificationService = $pushNotificationService;
    }

    public function index()
    {
        return $this->indexService->index();
    }

    public function push(Request $request)
    {
        return $this->pushNotificationService->push($request);
    }
}
