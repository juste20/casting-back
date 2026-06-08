<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin | Casting.net</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<div class="grain"></div>

<div class="login-page">
    <div class="login-card">
        <a class="login-brand">
            <div class="login-brand-icon">
                <img src="{{ asset('img/castinglogo.svg') }}" alt="Casting.net">
            </div>
            <span class="login-brand-text">CASTING<span class="login-accent">.NET</span></span>
        </a>
        <p class="login-sub">Administration</p>

        @if($errors->any())
            <div class="alert-error">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <input type="email" name="email" placeholder="admin@casting.net" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Mot de passe</label>
                <div class="input-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" name="password" placeholder="********" required>
                </div>
            </div>

            <label class="checkbox-wrap">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="check-box"></span>
                Se souvenir de moi
            </label>

            <button type="submit" class="btn-submit">
                Se connecter
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
        </form>
    </div>
</div>

<style>
:root {
    --red: #e50914;
    --red-dark: #b20710;
    --bg: #0a0a0a;
    --elevated: #141414;
    --glass: rgba(255,255,255,0.03);
    --glass-border: rgba(255,255,255,0.06);
    --text: #ffffff;
    --text-dim: #808080;
    --text-muted: #9ca3af;
    --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    --font-heading: 'EB Garamond', 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', serif;
}

*, *::before, *::after { box-sizing: border-box; }

body {
    margin: 0;
    font-family: var(--font);
    background: var(--bg);
    color: var(--text);
    -webkit-font-smoothing: antialiased;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
}

.grain {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    opacity: 0.03;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
    background-repeat: repeat;
    background-size: 256px 256px;
}

.login-page {
    width: 100%;
    max-width: 400px;
    position: relative;
    z-index: 1;
}

.login-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.97) 0%, rgba(10,10,10,0.99) 100%);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 40px 32px;
    text-align: center;
    animation: fadeUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) both;
}

.login-brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    font-size: 1.5rem;
    font-weight: 900;
    color: #fff;
    text-decoration: none;
    margin-bottom: 16px;
    transition: transform 0.3s ease;
}

.login-brand:hover {
    transform: scale(1.05);
}

.login-brand-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    overflow: hidden;
    flex-shrink: 0;
}

.login-brand-icon img {
    width: 200%;
    height: 200%;
    object-fit: contain;
    transform: scale(2);
    filter: brightness(0) saturate(100%) invert(13%) sepia(94%) saturate(7466%) hue-rotate(356deg) brightness(91%) contrast(119%) drop-shadow(0 0 0.5px #e50914) drop-shadow(0 0 0.5px #e50914);
}

.login-brand-text {
    letter-spacing: -0.5px;
    font-family: var(--font-heading);
    font-weight: 700;
}

.login-accent {
    color: #e50914;
}

.login-sub {
    font-size: 13px;
    color: var(--text-dim);
    margin: 0 0 28px;
    text-align: center;
}

.alert-error {
    background: rgba(229,9,20,0.08);
    color: var(--red);
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 500;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: 1px solid rgba(229,9,20,0.15);
}

.form-group {
    text-align: left;
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 6px;
}

.input-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.03);
    border: 1px solid var(--glass-border);
    border-radius: 10px;
    padding: 0 14px;
    transition: all 0.2s ease;
}

.input-wrap:focus-within {
    border-color: rgba(229,9,20,0.3);
    background: rgba(229,9,20,0.03);
    box-shadow: 0 0 0 3px rgba(229,9,20,0.06);
}

.input-wrap svg { color: var(--text-dim); flex-shrink: 0; }
.input-wrap:focus-within svg { color: var(--red); }

.input-wrap input {
    flex: 1;
    padding: 12px 0;
    border: none;
    background: transparent;
    font-size: 13px;
    font-family: inherit;
    color: #fff;
    outline: none;
}

.input-wrap input::placeholder { color: var(--text-dim); opacity: 0.5; }

.checkbox-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
    color: var(--text-dim);
    cursor: pointer;
    margin-bottom: 24px;
    position: relative;
    padding-left: 26px;
}

.checkbox-wrap input {
    position: absolute;
    opacity: 0;
    height: 0;
    width: 0;
}

.check-box {
    position: absolute;
    left: 0;
    height: 16px;
    width: 16px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--glass-border);
    border-radius: 4px;
    transition: all 0.15s ease;
}

.checkbox-wrap:hover .check-box { border-color: rgba(255,255,255,0.2); }

.checkbox-wrap input:checked ~ .check-box {
    background: var(--red);
    border-color: var(--red);
}

.check-box::after {
    content: '';
    position: absolute;
    display: none;
    left: 4px;
    top: 1px;
    width: 5px;
    height: 8px;
    border: solid #fff;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

.checkbox-wrap input:checked ~ .check-box::after { display: block; }

.btn-submit {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    border: none;
    border-radius: 10px;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(255,255,255,0.15), transparent 60%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(229,9,20,0.4);
}

.btn-submit:hover::before { opacity: 1; }

.btn-submit:active { transform: translateY(0); }

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 480px) {
    .login-card { padding: 28px 20px; }
}
</style>

</body>
</html>
