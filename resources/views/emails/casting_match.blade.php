<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Casting correspondant à votre profil</title>
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
        .details {
            background: #f8fafc;
            border-left: 4px solid #1e3a8a;
            padding: 15px 18px;
            margin: 20px 0;
            border-radius: 6px;
        }
        .details p {
            margin: 6px 0;
        }
        .details strong {
            color: #111;
        }
        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 12px 24px;
            background: #1e3a8a;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
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
    <h2>Un casting correspond à votre profil !</h2>

    <p>Bonjour {{ $subscription->fullname }},</p>

    <p>
        Bonne nouvelle : un nouveau casting vient d'être validé dans une catégorie
        qui correspond à votre inscription sur Casting.net.
    </p>

    <div class="details">
        <p><strong>Titre :</strong> {{ $casting->title }}</p>
        <p><strong>Pays :</strong> {{ $casting->country }}</p>
        @if($casting->start_date)
            <p>
                <strong>Période :</strong>
                {{ \Illuminate\Support\Carbon::parse($casting->start_date)->format('d/m/Y') }}
                @if($casting->end_date)
                    au {{ \Illuminate\Support\Carbon::parse($casting->end_date)->format('d/m/Y') }}
                @endif
            </p>
        @endif
        <p><strong>Description :</strong><br>{{ \Illuminate\Support\Str::limit($casting->description, 400) }}</p>
    </div>
    <a href="{{ rtrim(config('app.frontend_url', config('app.url')), '/') }}/casting" class="btn">
        Voir les castings disponibles
    </a>

    <p style="margin-top: 24px;">
        Bonne chance,<br>
        <strong>L'équipe Casting.net</strong>
    </p>

    <div class="footer">
        &copy; {{ date('Y') }} Casting.net — Tous droits réservés
    </div>
</div>
</body>
</html>