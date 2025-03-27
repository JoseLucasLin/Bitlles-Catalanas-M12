<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación - Bitlles Catalanes</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f6f4f2;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin: 0 auto;">
        <!-- ENCABEZADO -->
        <tr>
            <td align="center" bgcolor="#2f3b64" style="padding: 30px 20px;">
                <h1 style="color: #ffffff; margin: 0;">Bitlles Catalanes</h1>
            </td>
        </tr>

        <!-- CONTENIDO PRINCIPAL -->
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px; border-left: 1px solid #e5e2dd; border-right: 1px solid #e5e2dd;">
                <h2 style="color: #2f3b64; margin-top: 0;">Hola {{$name}},</h2>
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Gracias por registrarte en nuestra plataforma de Bitlles Catalanes. Para completar tu proceso de verificación, utiliza el siguiente código:
                </p>

                <!-- CÓDIGO DE VERIFICACIÓN -->
                <div style="background-color: #e5e2dd; padding: 20px; text-align: center; margin: 30px 0; border-radius: 5px;">
                    <p style="font-size: 14px; margin-bottom: 10px; color: #2f3b64;">Tu código de verificación es:</p>
                    <p style="font-size: 28px; font-weight: bold; letter-spacing: 5px; margin: 0; color: #be1622;">{{ $codigo ?? 'CÓDIGO' }}</p>
                </div>

                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Este código es válido durante 30 minutos. Si no has solicitado este código, puedes ignorar este correo.
                </p>
            </td>
        </tr>

        <!-- INSTRUCCIONES -->
        <tr>
            <td bgcolor="#ffffff" style="padding: 0 30px 30px; border-left: 1px solid #e5e2dd; border-right: 1px solid #e5e2dd;">
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Para completar la verificación:
                </p>
                <ol style="color: #333333; font-size: 16px; line-height: 1.6;">
                    <li>Introduce el código en la página de verificación</li>
                    <li>Haz clic en "Verificar"</li>
                    <li>¡Empieza a disfrutar de todas las funcionalidades!</li>
                </ol>
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
