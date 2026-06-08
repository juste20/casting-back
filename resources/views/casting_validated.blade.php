<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Casting validé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef6ff;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
        }
        h2 {
            color: #16a34a;
        }
        p {
            color: #333;
        }
        .badge {
            display: inline-block;
            padding: 6px 12px;
            background: #16a34a;
            color: #fff;
            border-radius: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Casting valide</h2>

    <p class="badge">Validé</p>

    <p>
        Félicitations !
        Votre casting <strong>{{ $casting->title }}</strong>
        a été validé et distribué avec succès.
    </p>

    <p>
        Les acteurs correspondant à vos critères recevront les informations.
    </p>

    <p>
        Bonne continuation,<br>
        <strong>L’équipe Casting.net</strong>
    </p>
</div>
</body>
</html>
