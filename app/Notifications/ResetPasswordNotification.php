<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Restablecer contraseña - Bitlles Catalanes')
            ->greeting('Hola')
            ->line('Has recibido este correo porque solicitaste restablecer tu contraseña.')
            ->action('Restablecer Contraseña', url(route('password.reset', [
                'token' => $this->token,
                'mail' => $notifiable->getEmailForPasswordReset(),
            ], false)))
            ->line('Este enlace expirará en ' . config('auth.passwords.users.expire') . ' minutos.')
            ->line('Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.')
            ->salutation('Saludos, Equipo de Bitlles Catalanes');
    }
}
