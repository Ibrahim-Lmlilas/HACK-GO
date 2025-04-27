<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function getUserNotifications()
    {
        $notifications = $this->notificationService->getUserNotifications(Auth::user());
        return view('notifications.index', compact('notifications'));
    }

    public function getAdminNotifications()
    {
        $notifications = $this->notificationService->getAdminNotifications(Auth::user());
        return view('notifications.admin', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        $this->notificationService->markAsRead($notification);
        return back()->with('success', 'Notification marked as read');
    }
}
