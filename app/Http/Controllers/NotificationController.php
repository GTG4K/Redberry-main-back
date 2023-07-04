<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $user = User::with('notificationsReceived.sender')->find(auth()->user()->id);
        $notifications = $user->notificationsReceived;
        return ['notifications' => NotificationResource::collection($notifications), 'new' => Notification::newNotifications()];
    }

    public function seen($id){
        $notification = Notification::find($id);
        $notification->is_read = 1;
        $notification->save();
        return response()->json(['message'=>'notification updated']);
    }

    public function allSeen(){
        Notification::allSeen();
        return response()->json(['message'=>'notifications updated']);
    }
}
