<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
</head>
<body>

<div class="login-container">
    <h2>Connexion Admin</h2>

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <input
            type="email"
            name="email"
            id="email"
            placeholder="Email"
            value="{{ old('email') }}"
            required
            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
            title="Veuillez saisir une adresse email valide"
        />

        <div class="input-container">
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Mot de passe"
                required
            />
            <span class="toggle-password" onclick="togglePassword()">
                👁️‍🗨️
            </span>
        </div>

        <div class="remember-me">
            <input
                type="checkbox"
                name="remember"
                id="remember"
                {{ old('remember') ? 'checked' : '' }}
            >
            <label for="remember">Se souvenir de moi</label>
        </div>

        <button type="submit">Se connecter</button>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.toggle-password');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.textContent = '👁️';
        } else {
            passwordInput.type = 'password';
            icon.textContent = '👁️‍🗨️';
        }
    }

    // Autoriser uniquement les caractères valides dans un email
    document.getElementById('email').addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9@._%+-]/g, '');
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        width: 90%;
        max-width: 400px;
        box-sizing: border-box;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .input-container {
        position: relative;
        margin: 8px 0;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px 40px 10px 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        font-size: 16px;
        margin-bottom: 8px;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: #888;
        user-select: none;
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin: 10px 0;
        font-size: 14px;
    }

    .remember-me input {
        width: auto;
        margin-right: 8px;
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background: #38bdf8;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .login-container button:hover {
        background: #0ea5e9;
    }

    .error {
        color: #ef4444;
        font-size: 14px;
        margin-bottom: 10px;
    }

    @media (max-width: 400px) {
        .login-container {
            padding: 20px;
        }

        .login-container input,
        .login-container button {
            font-size: 14px;
        }
    }
</style>

</body>
</html>