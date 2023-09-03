<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 16px;">
    <p>Dear {{ $user->prenom }},</p>

    <p>Thank you for subscribing to our health startup! Please click the button below to confirm your email address:</p>

    <p style="text-align: center; margin: 30px 0;">
        <a href="{{ route('emails.verify', ['id' => $user->id, 'hash' => $user->verification_token]) }}">Click here to verify your email</a>
    </p>
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif

    <p>
        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </p>
    
    <p>Your token will expire in 1 hour !</p>

    <p>If you did not subscribe to our health startup, please ignore this email.</p>

    <p>Best regards,</p>
    <p>The Health Startup Team</p>
</body>

</html>