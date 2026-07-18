@extends('layouts.game')
@section('title', 'Mapa del Juego - TrignoQuest')

@section('content')
<div class="map-page">
    <div class="map-header">
        <h1>🗺️ Mapa de <span style="background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Aventura</span></h1>
        <p>Elige un mundo y comienza a conquistar lecciones</p>
    </div>

    <div class="worlds-grid">
        @foreach($worldsData as $index => $data)
            @if($index > 0)
                <div class="world-connector">
                    <div class="dots">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>
            @endif

            @php $world = $data['world']; @endphp
            <div class="world-card {{ !$data['unlocked'] ? 'locked' : '' }}" style="--world-color: {{ $world->color }};">
                <div style="position:absolute;top:0;left:0;right:0;height:3px;background:{{ $world->bg_gradient }};border-radius:3px 3px 0 0;"></div>

                <div class="world-icon" style="border-color: {{ $world->color }}33; background: {{ $world->color }}15;">
                    {{ $world->icon }}
                </div>

                <div class="world-info">
                    <h2>{{ $world->name }}</h2>
                    <p>{{ $world->description }}</p>
                    <div class="world-meta">
                        <span class="world-meta-item">📚 {{ $data['totalLessons'] }} lecciones</span>
                        <span class="world-meta-item">⭐ {{ $data['totalStars'] }}/{{ $data['maxStars'] }} estrellas</span>
                        @if($data['unlocked'])
                            <a href="{{ route('game.world', $world->slug) }}" class="btn btn-sm btn-primary">
                                {{ $data['progress'] > 0 ? '▶️ Continuar' : '🚀 Comenzar' }}
                            </a>
                        @endif
                    </div>
                </div>

                @if($data['unlocked'])
                    <div class="world-progress-area">
                        <div class="world-progress-ring">
                            <svg viewBox="0 0 72 72">
                                <circle class="track" cx="36" cy="36" r="33"/>
                                <circle class="fill" cx="36" cy="36" r="33" 
                                    style="stroke: {{ $world->color }}; stroke-dashoffset: {{ 207 - (207 * $data['progress'] / 100) }}"/>
                            </svg>
                            <span class="world-progress-text" style="color: {{ $world->color }}">{{ $data['progress'] }}%</span>
                        </div>
                        <div class="world-stars">
                            {{ $data['completedLessons'] }}/{{ $data['totalLessons'] }} completadas
                        </div>
                    </div>
                @else
                    <div class="world-lock">
                        <span class="world-lock-icon">🔒</span>
                        <span class="world-lock-text">Necesitas {{ $world->xp_required }} XP</span>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
