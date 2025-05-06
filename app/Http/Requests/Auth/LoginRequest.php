<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'mail' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }



    public function rules(): array
    {
        return [
            'mail' => ['required', 'string'], // Cambiar de 'email' a 'mail'
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): string
    {
        $this->ensureIsNotRateLimited();

        // Cambiar $this->email a $this->mail
        if (!Auth::attempt(['mail' => $this->mail, 'password' => $this->password], $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'mail' => trans('auth.failed'), // Cambiar 'email' a 'mail'
            ]);
        }

        RateLimiter::clear($this->throttleKey());
            // Generar un token JWT para el usuario autenticado
    return JWTAuth::fromUser(Auth::user());
    }

    // También en el método throttleKey() cambiar:
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('mail')).'|'.$this->ip());
    }
}
