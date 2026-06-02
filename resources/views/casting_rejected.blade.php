<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Casting rejeté</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff1f2;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
        }
        h2 {
            color: #dc2626;
        }
        .reason {
            background: #fee2e2;
            padding: 15px;
            border-left: 4px solid #dc2626;
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Casting rejeté</h2>

    <p>
        Votre casting <strong>{{ $casting->title }}</strong>
        n’a pas été validé.
    </p>

    <div class="reason">
        <strong>Motif :</strong><br>
        {{ $reason }}
    </div>

    <p>
        Vous pouvez corriger et soumettre à nouveau votre casting.
    </p>

    <p>
        L’équipe Casting.net
    </p>
</div>
</body>
</html>
