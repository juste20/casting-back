<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut du paiement / Payment Status | Casting.net</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background-image: radial-gradient(ellipse at 50% 0%, rgba(229,9,20,0.08) 0%, transparent 70%);
        }
        .card {
            max-width: 440px;
            width: 100%;
            background: linear-gradient(145deg, rgba(20,20,20,0.98), rgba(10,10,10,0.98));
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px;
            padding: 48px 36px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.6);
            animation: fadeUp 0.4s ease both;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .logo {
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.5px;
            margin-bottom: 28px;
        }
        .logo span { color: #e50914; }
        .icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .icon-success { background: rgba(16,185,129,0.15); }
        .icon-failed { background: rgba(229,9,20,0.15); }
        .icon-wrap svg { width: 32px; height: 32px; }
        .icon-success svg { color: #34d399; }
        .icon-failed svg { color: #e50914; }
        h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .success { color: #34d399; }
        .failed { color: #e50914; }
        p {
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .btn-primary {
            background: #e50914;
            color: #fff;
            border: none;
        }
        .btn-primary:hover {
            background: #b20710;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(229,9,20,0.3);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.04);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.08);
        }
        .countdown {
            font-size: 12px;
            color: #808080;
            margin-top: 20px;
        }
        .grain {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 256px 256px;
        }
    </style>
</head>
<body>
<div class="grain"></div>
<div class="card">
    <div class="logo">CASTING<span>.NET</span></div>

    @if($status === 'approved' || $status === 'success')
        <div class="icon-wrap icon-success">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-5"/>
            </svg>
        </div>
        <h1 class="success">Paiement reussi !</h1>
        <p>Votre inscription a ete finalisee. Vous recevrez une notification des que de nouveaux castings correspondant a votre profil seront disponibles.</p>
        <a href="{{ config('app.frontend_url', '/') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Retour a l'accueil
        </a>
    @elseif($status === 'canceled')
        <div class="icon-wrap icon-failed">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/>
            </svg>
        </div>
        <h1 class="failed">Paiement annule</h1>
        <p>Vous avez annule le paiement. Aucun montant n'a ete debite. Vous pouvez reessayer quand vous voulez.</p>
        <a href="{{ config('app.frontend_url', '/casting') }}" class="btn btn-primary">Reessayer le paiement</a>
    @else
        <div class="icon-wrap icon-failed">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/>
            </svg>
        </div>
        <h1 class="failed">Paiement echoue</h1>
        <p>{{ $message }}</p>
        <a href="{{ config('app.frontend_url', '/casting') }}" class="btn btn-primary">Reessayer</a>
    @endif

    <p class="countdown">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Redirection dans <span id="countdown">5</span> secondes...
    </p>
</div>

<script>
(function() {
    var seconds = 5;
    var target = '{{ $status === "approved" || $status === "success" ? config("app.frontend_url", "/") : config("app.frontend_url", "/casting") }}';
    var el = document.getElementById('countdown');
    var interval = setInterval(function() {
        seconds--;
        if (el) el.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = target;
        }
    }, 1000);
})();
</script>
</body>
</html>
