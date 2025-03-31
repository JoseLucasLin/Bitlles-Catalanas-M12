<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Users'; // Asegúrate de que coincida con el nombre de la tabla

    protected $fillable = [
        'username',
        'mail',
        'password',
        'role',
        'image',
        'last_login',
        'attemp_logins'
    ];

    protected $hidden = [
        'password',
    ];

    public function getEmailAttribute()
    {
        return $this->mail;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['mail'] = $value;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role');
    }

    public function getEmailForPasswordReset(): string
    {
        return $this->mail;
    }

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
