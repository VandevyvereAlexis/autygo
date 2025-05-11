<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vérification d’e-mail</title>
    </head>

    <body>
        <p>Bonjour {{ $prenom }},</p>
    <p>Pour activer votre compte AutyGo, cliquez sur le lien ci-dessous :</p>
    <p>
        <a href="{{ config('app.frontend_url') }}/verify-email/{{ $token }}">
        Activer mon compte
        </a>
    </p>
    <p>À bientôt !</p>
    </body>
</html>