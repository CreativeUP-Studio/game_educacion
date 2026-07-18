@extends('layouts.game')
@section('title', 'Registro - TrignoQuest')
@section('body-class', 'welcome-page')
@section('main-class', 'no-nav')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <span class="auth-logo">🔺</span>
            <h1 class="auth-title">Únete a la aventura</h1>
            <p class="auth-subtitle">Crea tu personaje y comienza a aprender</p>
        </div>

        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">🧙 Nombre de héroe</label>
                <input type="text" name="name" id="name" class="form-input" placeholder="Tu nombre de aventurero" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="email">📧 Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-input" placeholder="tu@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">🔒 Contraseña secreta</label>
                <input type="password" name="password" id="password" class="form-input" placeholder="Mínimo 6 caracteres" required>
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">🔒 Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Repite tu contraseña" required>
            </div>

            <button type="submit" class="btn btn-gold" style="width: 100%;" id="registerBtn">
                ⚔️ Crear Personaje
            </button>
        </form>

        <div class="auth-footer">
            ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </div>
</div>
@endsection
