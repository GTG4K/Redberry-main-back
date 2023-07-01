<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }

    public static function newNotifications()
    {
        $newNotifications = 0;
        $notifications = Notification::where('user_id', auth()->user()->id)->get();
        foreach ($notifications as $notification) {
            if (!$notification->is_read) $newNotifications++;
        }
        return $newNotifications;
    }

    public static function allSeen(){
        $user = User::find(auth()->user()->id);
        $notifications = $user->notificationsReceived;
        foreach ($notifications as $notification){
            $notification->is_read = 1;
            $notification->save();
        }
    }
}
