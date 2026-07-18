<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="TrignoQuest - Aprende trigonometría jugando. Un juego educativo interactivo para estudiantes de educación básica.">
    <title>@yield('title', 'TrignoQuest - Aprende Trigonometría Jugando')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class', '')">
    @auth
    <nav class="game-nav" id="gameNav">
        <div class="nav-container">
            <a href="{{ route('game.map') }}" class="nav-brand">
                <span class="nav-logo">🔺</span>
                <span class="nav-title">TrignoQuest</span>
            </a>

            <div class="nav-center">
                <a href="{{ route('game.map') }}" class="nav-link {{ request()->routeIs('game.map') ? 'active' : '' }}">
                    <span class="nav-icon">🗺️</span> Mapa
                </a>
                <a href="{{ route('game.laboratory') }}" class="nav-link {{ request()->routeIs('game.laboratory') ? 'active' : '' }}">
                    <span class="nav-icon">🧪</span> Laboratorio
                </a>
                <a href="{{ route('game.leaderboard') }}" class="nav-link {{ request()->routeIs('game.leaderboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏆</span> Ranking
                </a>
                <a href="{{ route('game.profile') }}" class="nav-link {{ request()->routeIs('game.profile') ? 'active' : '' }}">
                    <span class="nav-icon">👤</span> Perfil
                </a>
            </div>

            <div class="nav-right">
                <div class="nav-xp-bar" title="XP: {{ auth()->user()->xp }} / {{ auth()->user()->xpForNextLevel() }}">
                    <div class="xp-info">
                        <span class="xp-level">Nv.{{ auth()->user()->level }}</span>
                        <span class="xp-title">{{ auth()->user()->level_title }}</span>
                    </div>
                    <div class="xp-bar-track">
                        <div class="xp-bar-fill" style="width: {{ auth()->user()->xpProgress() }}%"></div>
                    </div>
                    <span class="xp-text">{{ auth()->user()->xp }} XP</span>
                </div>

                <div class="nav-avatar-wrapper">
                    <div class="nav-avatar" data-avatar="{{ auth()->user()->avatar }}">
                        @php
                            $avatars = ['wizard'=>'🧙','warrior'=>'⚔️','archer'=>'🏹','mage'=>'🔮','knight'=>'🛡️','ninja'=>'🥷'];
                        @endphp
                        {{ $avatars[auth()->user()->avatar] ?? '🧙' }}
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="nav-logout-form">
                    @csrf
                    <button type="submit" class="nav-logout-btn" title="Cerrar sesión">🚪</button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <main class="game-main @yield('main-class', '')">
        @if(session('success'))
            <div class="alert alert-success" id="alertSuccess">
                <span>✅ {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="alert-close">&times;</button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error" id="alertError">
                <span>❌ {{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="alert-close">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        window.csrfToken = '{{ csrf_token() }}';
    </script>
    @stack('scripts')
</body>
</html>
