@extends('layouts.game')
@section('title', 'Mapa del Juego - TrignoQuest')

@section('content')
<div class="adventure-map">
    {{-- Animated background decorations --}}
    <div class="map-bg-stars" id="mapStars"></div>
    <div class="map-bg-deco">
        <div class="deco-mountain deco-mountain--left"></div>
        <div class="deco-mountain deco-mountain--right"></div>
        <div class="deco-cloud deco-cloud--1">☁️</div>
        <div class="deco-cloud deco-cloud--2">☁️</div>
        <div class="deco-cloud deco-cloud--3">⛅</div>
    </div>

    {{-- Player stats sidebar --}}
    <div class="map-stats-panel">
        <div class="stats-avatar">
            @php
                $avatars = ['wizard'=>'🧙','warrior'=>'⚔️','archer'=>'🏹','mage'=>'🔮','knight'=>'🛡️','ninja'=>'🥷'];
            @endphp
            <span class="stats-avatar-icon">{{ $avatars[$user->avatar] ?? '🧙' }}</span>
        </div>
        <h3 class="stats-name">{{ $user->name }}</h3>
        <span class="stats-title">{{ $user->level_title }}</span>

        <div class="stats-grid">
            <div class="stat-box">
                <span class="stat-value">{{ $user->xp }}</span>
                <span class="stat-label">XP Total</span>
            </div>
            <div class="stat-box">
                <span class="stat-value">Nv.{{ $user->level }}</span>
                <span class="stat-label">Nivel</span>
            </div>
            <div class="stat-box">
                <span class="stat-value">{{ $worldsData->where('progress', 100)->count() }}/{{ $worldsData->count() }}</span>
                <span class="stat-label">Mundos</span>
            </div>
            <div class="stat-box">
                <span class="stat-value">{{ $worldsData->sum('totalStars') }}</span>
                <span class="stat-label">⭐ Estrellas</span>
            </div>
        </div>

        <div class="stats-xp-bar">
            <div class="stats-xp-label">Siguiente nivel</div>
            <div class="stats-xp-track">
                <div class="stats-xp-fill" style="width: {{ $user->xpProgress() }}%"></div>
            </div>
            <div class="stats-xp-text">{{ $user->xp }} / {{ $user->xpForNextLevel() }} XP</div>
        </div>
    </div>

    {{-- Main map path --}}
    <div class="map-path-container">
        <h1 class="map-title">
            <span class="map-title-icon">🗺️</span>
            Mapa de <span class="map-title-highlight">Aventura</span>
        </h1>
        <p class="map-subtitle">Conquista cada mundo para avanzar en tu viaje trigonométrico</p>

        {{-- SVG Path that connects worlds --}}
        <div class="map-trail">
            @php $totalWorlds = count($worldsData); @endphp

            @foreach($worldsData as $index => $data)
                @php
                    $world = $data['world'];
                    $isUnlocked = $data['unlocked'];
                    $isCompleted = $data['progress'] >= 100;
                    $isEven = $index % 2 === 0;
                    $nodeDelay = $index * 0.15;
                @endphp

                {{-- Connector line to previous --}}
                @if($index > 0)
                    <div class="trail-connector {{ $isUnlocked ? 'active' : '' }}">
                        <svg viewBox="0 0 200 80" preserveAspectRatio="none" class="trail-svg">
                            <path d="M 100 0 C 100 30, {{ $isEven ? '30' : '170' }} 50, 100 80"
                                  class="trail-path {{ $isUnlocked ? 'trail-path--active' : '' }}" />
                        </svg>
                        {{-- Decorations on trail --}}
                        @if($index === 1)
                            <span class="trail-deco" style="left: 20%;">🌿</span>
                        @elseif($index === 2)
                            <span class="trail-deco" style="left: 75%;">🏕️</span>
                        @elseif($index === 3)
                            <span class="trail-deco" style="left: 30%;">🔥</span>
                        @elseif($index === 4)
                            <span class="trail-deco" style="left: 65%;">🚩</span>
                        @elseif($index === 5)
                            <span class="trail-deco" style="left: 40%;">💎</span>
                        @endif
                    </div>
                @endif

                {{-- World Node --}}
                <div class="world-node {{ $isEven ? 'node--left' : 'node--right' }} {{ !$isUnlocked ? 'node--locked' : '' }} {{ $isCompleted ? 'node--completed' : '' }}"
                     style="--node-color: {{ $world->color }}; --node-delay: {{ $nodeDelay }}s;">

                    @if($isUnlocked)
                        <a href="{{ route('game.world', $world->slug) }}" class="node-link">
                    @else
                        <div class="node-link node-link--disabled">
                    @endif

                        {{-- Glow ring --}}
                        <div class="node-ring">
                            {{-- Progress ring --}}
                            <svg class="node-progress-svg" viewBox="0 0 120 120">
                                <circle class="node-track" cx="60" cy="60" r="54" />
                                @if($isUnlocked)
                                    <circle class="node-fill" cx="60" cy="60" r="54"
                                        style="stroke: {{ $world->color }};
                                               stroke-dashoffset: {{ 339 - (339 * $data['progress'] / 100) }};" />
                                @endif
                            </svg>

                            {{-- Center circle with icon --}}
                            <div class="node-center" style="background: {{ $world->color }}22; border-color: {{ $world->color }}55;">
                                @if(!$isUnlocked)
                                    <span class="node-lock">🔒</span>
                                @else
                                    <span class="node-icon">{{ $world->icon }}</span>
                                @endif
                            </div>

                            {{-- Completion badge --}}
                            @if($isCompleted)
                                <div class="node-badge">✅</div>
                            @endif
                        </div>

                        {{-- World info card --}}
                        <div class="node-info">
                            <h3 class="node-name" style="color: {{ $isUnlocked ? $world->color : 'var(--text-muted)' }}">
                                {{ $world->name }}
                            </h3>
                            <p class="node-desc">{{ $world->description }}</p>

                            <div class="node-meta">
                                <span class="node-meta-item">📚 {{ $data['totalLessons'] }} lecciones</span>
                                <span class="node-meta-item">⭐ {{ $data['totalStars'] }}/{{ $data['maxStars'] }}</span>
                            </div>

                            @if($isUnlocked)
                                <div class="node-progress-bar">
                                    <div class="node-progress-fill" style="width: {{ $data['progress'] }}%; background: {{ $world->color }};"></div>
                                </div>
                                <span class="node-progress-label">{{ $data['progress'] }}% completado</span>
                            @else
                                <span class="node-lock-text">🔒 Necesitas {{ $world->xp_required }} XP</span>
                            @endif
                        </div>

                    @if($isUnlocked)
                        </a>
                    @else
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- Final treasure at end --}}
            <div class="trail-end">
                <span class="trail-end-icon">🏆</span>
                <span class="trail-end-text">¡Victoria Final!</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Generate floating star particles
    const starsContainer = document.getElementById('mapStars');
    if (starsContainer) {
        for (let i = 0; i < 40; i++) {
            const star = document.createElement('div');
            star.className = 'floating-star';
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            star.style.animationDelay = Math.random() * 6 + 's';
            star.style.animationDuration = (3 + Math.random() * 4) + 's';
            star.style.fontSize = (6 + Math.random() * 8) + 'px';
            star.textContent = Math.random() > 0.5 ? '✦' : '✧';
            starsContainer.appendChild(star);
        }
    }

    // Node entrance animations
    const nodes = document.querySelectorAll('.world-node');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('node--visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    nodes.forEach(n => observer.observe(n));
</script>
@endpush
@endsection
