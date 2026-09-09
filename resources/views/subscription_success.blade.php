<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription confirmée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0fdf4;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            border-radius: 8px;
        }
        h2 {
            color: #15803d;
        }
        a {
            color: #1d4ed8;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container" style="padding: 0; overflow: hidden;">
    @include('emails.partials.header')
    <div style="padding: 30px;">
        <h2>Inscription réussie</h2>

        <p>Bonjour {{ $subscription->fullname }},</p>

        <p>
            Votre inscription a été validée.
            Vous recevrez les castings correspondant à vos préférences.
        </p>

        <p>
            Pour vous inscrire et recevoir un autre casting :
            <a href="https://casting-net.com">cliquez ici</a>
        </p>
        <p>
            Vous pouvez faire autant d'inscriptions que vous souhaitez pour recevoir davantage de castings disponibles.
        </p>
        <p>
            Casting.net
        </p>
    </div>
</div>
</body>
</html>