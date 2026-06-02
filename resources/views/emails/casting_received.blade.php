<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Casting reçu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
        }
        h2 {
            color: #1e3a8a;
        }
        p {
            color: #444;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            font-size: 13px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Nouveau casting reçu</h2>

    <p>Bonjour,</p>

    <p>
        Nous confirmons la bonne réception de votre casting
        <strong>{{ $casting->title }}</strong>.
    </p>

    <p>
        Il est actuellement en cours de vérification par notre équipe.
        Vous recevrez une notification dès qu’une décision sera prise.
    </p>

    <p>Merci pour votre confiance.</p>

    <div class="footer">
        © {{ date('Y') }} Casting.net — Tous droits réservés
    </div>
</div>
</body>
</html>
