<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Admin | Casting.net</title>
</head>

<body>

    <div class="wrapper">

        <div class="sidebar">
            <h2>🎬 Casting.net</h2>

            <a class="{{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}"
                href="{{ route('admin.dashboard') }}">
                Dashboard
            </a>

            <a class="{{ request()->routeIs('admin.castings') ? 'active-menu' : '' }}"
                href="{{ route('admin.castings') }}">
                Castings
            </a>

            <a class="{{ request()->routeIs('admin.subscriptions') ? 'active-menu' : '' }}"
                href="{{ route('admin.subscriptions') }}">
                Inscriptions
            </a>

            <a class="{{ request()->routeIs('admin.payments') ? 'active-menu' : '' }}"
                href="{{ route('admin.payments') }}">
                Paiements
            </a>

            <a class="{{ request()->routeIs('admin.history.castings') ? 'active-menu' : '' }}"
                href="{{ route('admin.history.castings') }}">
                Historique Castings
            </a>

            <a class="{{ request()->routeIs('admin.history.subscriptions') ? 'active-menu' : '' }}"
                href="{{ route('admin.history.subscriptions') }}">
                Historique Inscriptions
            </a>

            <a class="{{ request()->routeIs('admin.archives') ? 'active-menu' : '' }}"
                href="{{ route('admin.archives') }}">
                Archives
            </a>

            <a class="{{ request()->routeIs('admin.notifications') ? 'active-menu' : '' }}"
                href="{{ route('admin.notifications') }}">
                Notifications
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    Déconnexion
                </button>
            </form>

        </div>

        <div class="content">

            <div class="header">
                <div class="header-title">
                    Bienvenue sur le dashboard admin de Casting.net
                </div>

                <div class="header-notif">
                    🔔
                    <span class="badge">
                        {{ $notificationsCount ?? 0 }}
                    </span>
                </div>
            </div>

            @yield('content')

        </div>

    </div>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: #020617;
            color: #ffffff;
            padding: 25px;
        }

        .sidebar h2 {
            color: #38bdf8;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .sidebar a {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 16px;
            transition: 0.2s ease;
        }

        .sidebar a:hover {
            background: #1e293b;
        }

        .sidebar a.active-menu {
            background: #facc15;
            color: #000;
            font-weight: bold;
        }

        /* BOUTON DECONNEXION */
        .logout-btn {
            width: 100%;
            background: none;
            border: none;
            color: #cbd5e1;
            text-align: left;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #1e293b;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 35px;
        }

        /* HEADER */
        .header {
            background: linear-gradient(90deg, #0f172a, #1e293b);
            color: #ffffff;
            padding: 20px 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
        }

        .header-notif {
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            background: #ef4444;
            color: #ffffff;
            border-radius: 50%;
            padding: 6px 10px;
            font-size: 13px;
            font-weight: bold;
        }
    </style>

</body>

</html>
