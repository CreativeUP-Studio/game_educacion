@extends('layouts.game')
@section('title', 'Iniciar Sesión - TrignoQuest')
@section('body-class', 'welcome-page')
@section('main-class', 'no-nav')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <span class="auth-logo">🔺</span>
            <h1 class="auth-title">Bienvenido de vuelta</h1>
            <p class="auth-subtitle">Continúa tu aventura trigonométrica</p>
        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">📧 Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="tu@email.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">🔒 Contraseña</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="••••••••" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;" id="loginBtn">
                🚀 Iniciar Aventura
            </button>
        </form>

        <div class="auth-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}">¡Crea una gratis!</a>
        </div>
    </div>
</div>
@endsection
