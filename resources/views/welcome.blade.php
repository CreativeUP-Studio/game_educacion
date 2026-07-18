@extends('layouts.game')
@section('title', 'TrignoQuest - Aprende Trigonometría Jugando')
@section('body-class', 'welcome-page')
@section('main-class', 'no-nav')

@section('content')
<div class="welcome-hero">
    <div class="floating-shapes">
        <div class="shape">📐</div>
        <div class="shape">🔺</div>
        <div class="shape">📏</div>
        <div class="shape">✨</div>
        <div class="shape">🔮</div>
        <div class="shape">⭐</div>
    </div>

    <div class="hero-content">
        <span class="hero-badge">🎮 Juego Educativo Interactivo</span>
        <h1 class="hero-title">
            <span class="gradient-text">Trigno</span><span class="gold-text">Quest</span>
        </h1>
        <p class="hero-subtitle">
            Embárcate en una aventura épica por el mundo de la trigonometría. 
            Aprende seno, coseno, tangente y más mientras conquistas niveles, 
            ganas estrellas y te conviertes en un ¡Maestro Trigonométrico! 🏆
        </p>

        <div class="hero-buttons">
            @auth
                <a href="{{ route('game.map') }}" class="btn btn-gold btn-lg">🗺️ Continuar Aventura</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">🚀 Comenzar Aventura</a>
                <a href="{{ route('login') }}" class="btn btn-outline btn-lg">🔑 Ya tengo cuenta</a>
            @endauth
        </div>

        <div class="hero-features">
            <div class="hero-feature">
                <span class="hero-feature-icon">🏔️</span>
                <h3>4 Mundos</h3>
                <p>Explora desde ángulos básicos hasta identidades trigonométricas</p>
            </div>
            <div class="hero-feature">
                <span class="hero-feature-icon">🧩</span>
                <h3>13 Lecciones</h3>
                <p>Contenido interactivo con visualizaciones y ejemplos</p>
            </div>
            <div class="hero-feature">
                <span class="hero-feature-icon">⚡</span>
                <h3>65+ Desafíos</h3>
                <p>Quizzes con preguntas que ponen a prueba tu conocimiento</p>
            </div>
            <div class="hero-feature">
                <span class="hero-feature-icon">🏆</span>
                <h3>Logros & Ranking</h3>
                <p>Desbloquea logros, sube de nivel y compite con otros</p>
            </div>
        </div>
    </div>
</div>
@endsection
