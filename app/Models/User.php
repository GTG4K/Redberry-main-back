<?php

namespace App\Models;

use App\Mail\CustomVerifyEmail;
use App\Notifications\VerifyEmailCustom;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'google_id',
        'google_token',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailCustom($this));
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getProfilePictureAttribute($value)
    {
        if ($this->google_id) {
            return $value;
        } else {
            return asset('storage/' . $value);
        }
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function movies()
    {
        return $this->hasMany(Movie::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function notificationsReceived()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function notificationsSent()
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
