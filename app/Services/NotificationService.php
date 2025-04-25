<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Trip;

class NotificationService
{
    public function createBookingNotification(User $user, Trip $trip): void
    {
        // Create notification for the user who booked
        Notification::create([
            'user_id' => $user->id,
            'type' => 'booking',
            'trip_id' => $trip->id,
            'message' => "You have successfully booked a trip to {$trip->name}",
            'is_for_admin' => false
        ]);

        // Create notification for admin
        Notification::create([
            'user_id' => $user->id,
            'type' => 'booking',
            'trip_id' => $trip->id,
            'message' => "New booking by {$user->name} for trip {$trip->name}",
            'is_for_admin' => true
        ]);
    }

    public function createChannelJoinNotification(User $user, Trip $trip): void
    {
        Notification::create([
            'user_id' => $user->id,
            'type' => 'channel_join',
            'trip_id' => $trip->id,
            'message' => "You have joined the channel for trip {$trip->name}",
            'is_for_admin' => false
        ]);
    }

    public function getAdminNotifications()
    {
        return Notification::where('is_for_admin', true)
            ->with(['user', 'trip'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getUserNotifications(User $user)
    {
        return Notification::where('user_id', $user->id)
            ->where('is_for_admin', false)
            ->with(['trip'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function markAsRead(Notification $notification): void
    {
        $notification->update(['is_read' => true]);
    }
}
