<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 16px;">
    <p>Dear {{ $user->prenom }},</p>

    <p>Thank you for subscribing to our health startup!</p>
    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ route('login') }}">Log in</a>
    </p>
    <p>If you did not subscribe to our health startup, please ignore this email.</p>

    <p>Best regards,</p>
    <p>The Health Startup Team</p>
</body>
</html>