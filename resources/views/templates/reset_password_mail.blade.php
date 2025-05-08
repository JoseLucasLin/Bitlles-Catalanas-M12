<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña - Bitlles Catalanes</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f6f4f2;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto;">
        <!-- ENCABEZADO -->
        <tr>
            <td align="center" bgcolor="#2f3b64" style="padding: 20px;">
                <img src="https://i.imgur.com/tGBO1Lt.png" alt="Bitlles Catalanes" style="max-height: 80px; display: block;">
                <h1 style="color: #ffffff; margin: 10px 0 0 0; font-size: 24px;">Bitlles Catalanes</h1>
            </td>
        </tr>

        <!-- CONTENIDO PRINCIPAL -->
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px; border-left: 1px solid #e5e2dd; border-right: 1px solid #e5e2dd;">
                <h2 style="color: #2f3b64; margin-top: 0;">Hola,</h2>
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Has recibido este correo porque solicitaste restablecer tu contraseña. Haz clic en el botón de abajo para crear una nueva contraseña:
                </p>

                <!-- BOTÓN DE RESTABLECIMIENTO -->
                <div style="text-align: center; margin: 30px 0;">
                    <a href="{{ $resetUrl }}" style="background-color: #be1622; color: #ffffff; text-decoration: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; display: inline-block; font-size: 16px;">
                        Restablecer Contraseña
                    </a>
                </div>

            </td>
        </tr>

        <!-- INSTRUCCIONES -->
        <tr>
            <td bgcolor="#ffffff" style="padding: 0 30px 30px; border-left: 1px solid #e5e2dd; border-right: 1px solid #e5e2dd;">
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Si el botón no funciona, puedes copiar y pegar el siguiente enlace en tu navegador:
                </p>
                <div style="background-color: #e5e2dd; padding: 15px; text-align: center; margin: 10px 0; border-radius: 5px; word-break: break-all;">
                    <p style="font-size: 14px; margin: 0; color: #2f3b64;">{{ $resetUrl }}</p>
                </div>

                <p style="color: #333333; font-size: 16px; line-height: 1.6; margin-top: 20px;">
                    Este enlace expirará en {{ config('auth.passwords.users.expire', 60) }} minutos.
                </p>

                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Si no solicitaste restablecer tu contraseña, puedes ignorar este mensaje.
                </p>
            </td>
        </tr>

        <!-- PIE DE PÁGINA -->
        <tr>
            <td bgcolor="#2f3b64" style="padding: 20px; text-align: center; color: #ffffff; font-size: 14px; border-radius: 0 0 5px 5px;">
                <p style="margin: 0 0 10px 0;">© 2025 Bitlles Catalanes. Todos los derechos reservados.</p>
                <p style="margin: 0;">
                    <a href="#" style="color: #ffffff; text-decoration: underline;">Política de privacidad</a> |
                    <a href="#" style="color: #ffffff; text-decoration: underline;">Contacto</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
