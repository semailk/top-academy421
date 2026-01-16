<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Данные обновлены</title>
</head>
<body style="margin:0;padding:0;background:#f6f7f9;font-family:Arial,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" style="padding:30px 0;">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff;border-radius:8px;padding:24px;box-shadow:0 4px 10px rgba(0,0,0,0.05);">

                <tr>
                    <td>
                        <h2 style="margin-top:0;color:#111827;">
                            Здравствуйте, {{ $user->name }}!
                        </h2>

                        <p style="font-size:14px;color:#374151;line-height:1.6;">
                            Мы уведомляем вас о том, что данные вашего профиля были
                            <strong>успешно обновлены</strong>.
                        </p>

                        <p style="font-size:14px;color:#374151;line-height:1.6;">
                            Если это сделали вы — никаких действий не требуется.
                        </p>

                        <p style="font-size:14px;color:#dc2626;line-height:1.6;">
                            Если вы не вносили изменения, пожалуйста, немедленно
                            свяжитесь с нашей службой поддержки.
                        </p>

                        <hr style="border:none;border-top:1px solid #e5e7eb;margin:24px 0;">

                        <p style="font-size:12px;color:#6b7280;">
                            Дата обновления: {{ now()->format('d.m.Y H:i') }}
                        </p>

                        <p style="font-size:12px;color:#6b7280;">
                            Это автоматическое письмо, пожалуйста, не отвечайте на него.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>
</body>
</html>
