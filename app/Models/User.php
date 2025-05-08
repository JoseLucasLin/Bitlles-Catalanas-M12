<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'users';

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

        /**
     * Devuelve la clave única del usuario para el token JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Devuelve un array con las claims personalizadas del token JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
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
