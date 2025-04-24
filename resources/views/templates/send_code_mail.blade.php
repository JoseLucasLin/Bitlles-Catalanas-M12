<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificació - Bitlles Catalanes</title>
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
                <h2 style="color: #2f3b64; margin-top: 0;">Hola {{$name}},</h2>
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Gràcies per registrar-te a la nostra plataforma de Bitlles Catalanes. Per completar el procés de verificació, utilitza el següent codi:
                </p>

                <!-- CÓDIGO DE VERIFICACIÓN -->
                <div style="background-color: #e5e2dd; padding: 20px; text-align: center; margin: 30px 0; border-radius: 5px;">
                    <p style="font-size: 14px; margin-bottom: 10px; color: #2f3b64;">El teu codi de verificació és:</p>
                    <p style="font-size: 28px; font-weight: bold; letter-spacing: 5px; margin: 0; color: #be1622;">{{ $codigo ?? '1a2b3c4d' }}</p>
                </div>

            </td>
        </tr>

        <!-- INSTRUCCIONES -->
        <tr>
            <td bgcolor="#ffffff" style="padding: 0 30px 30px; border-left: 1px solid #e5e2dd; border-right: 1px solid #e5e2dd;">
                <p style="color: #333333; font-size: 16px; line-height: 1.6;">
                    Per completar la verificació:
                </p>
                <ol style="color: #333333; font-size: 16px; line-height: 1.6;">
                    <li>Introdueix el codi a la pàgina de verificació</li>
                    <li>Fes clic a "Verifica"</li>
                    <li>¡Comença a gaudir de totes les funcionalitats!</li>
                </ol>
            </td>
        </tr>

        <!-- PIE DE PÁGINA -->
        <tr>
            <td bgcolor="#2f3b64" style="padding: 20px; text-align: center; color: #ffffff; font-size: 14px; border-radius: 0 0 5px 5px;">
                <p style="margin: 0 0 10px 0;">© 2025 Bitlles Catalanes. Tots els drets reservats.</p>
                <p style="margin: 0;">
                    <a href="#" style="color: #ffffff; text-decoration: underline;">Política de privacitat</a> |
                    <a href="#" style="color: #ffffff; text-decoration: underline;">Contacte</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
