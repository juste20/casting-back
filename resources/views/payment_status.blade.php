<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statut du paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
        }
        .status {
            font-weight: bold;
            color: {{ $payment->status === 'success' ? '#16a34a' : '#dc2626' }};
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Statut de votre paiement</h2>

    <p><strong>Référence :</strong> {{ $payment->reference }}</p>
    <p><strong>Montant :</strong> {{ $payment->amount }} FCFA</p>
    <p>
        <strong>Statut :</strong>
        <span class="status">{{ strtoupper($payment->status) }}</span>
    </p>

    <p>
        Merci d’utiliser Casting.net
    </p>
</div>
</body>
</html>
