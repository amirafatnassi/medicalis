<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Confirmation</title>
</head>

<body style="font-family: Arial, sans-serif; font-size: 16px;">
    <p>Dear {{ $user->prenom }} {{ $user->nom }},</p>

    <p>The coordinator {{$coordinateur->prenom}} {{$coordinateur->nom}} has requested access to you medical dossier! Please click the button below to accept:</p>

    <p style="text-align: center; margin: 30px 0;">
    <a href="{{ route('emails.access_grant', ['dossier_id' => $dossier->id]) }}">Click here to grant access to your dossier</a>
    </p>
    
    <p>If you decline the request, please ignore this email.</p>

    <p>Best regards,</p>
    <p>The Health Startup Team</p>
</body>

</html>