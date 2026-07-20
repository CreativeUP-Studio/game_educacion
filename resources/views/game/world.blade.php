@extends('layouts.game')
@section('title', $world->name . ' - TrignoQuest')

@section('content')
<div class="world-page" style="--world-theme-color: {{ $world->color }};">
    <div class="world-nav-top">
        <a href="{{ route('game.map') }}" class="world-back">
            <span class="back-arrow">←</span> Volver al mapa de aventura
        </a>
    </div>

    <div class="world-header-banner" style="background: {{ $world->bg_gradient }}22; border-color: {{ $world->color }}44;">
        <div class="world-banner-glow" style="background: {{ $world->color }}15;"></div>
        <span class="world-header-icon">{{ $world->icon }}</span>
        <div class="world-header-info">
            <h1 style="color: {{ $world->color }};">{{ $world->name }}</h1>
            <p>{{ $world->description }}</p>
        </div>
        
        @php
            $totalLessons = count($lessonsData);
            $completedCount = collect($lessonsData)->where('isCompleted', true)->count();
            $progressPercent = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;
        @endphp

        <div class="world-header-stats">
            <div class="header-stat-box">
                <span class="stat-num">{{ $completedCount }}/{{ $totalLessons }}</span>
                <span class="stat-lbl">Lecciones</span>
            </div>
            <div class="header-stat-box">
                <span class="stat-num">{{ $progressPercent }}%</span>
                <span class="stat-lbl">Progreso</span>
            </div>
        </div>
    </div>

    <div class="lessons-path-container">
        <div class="lessons-path-line" style="border-color: {{ $world->color }}33;"></div>

        @foreach($lessonsData as $index => $data)
            @php 
                $lesson = $data['lesson'];
                $isUnlocked = $data['isUnlocked'];
                $isCompleted = $data['isCompleted'];
                $isCurrent = $isUnlocked && !$isCompleted;
            @endphp

            <div class="lesson-step {{ $isCompleted ? 'step--completed' : '' }} {{ $isCurrent ? 'step--current' : '' }} {{ !$isUnlocked ? 'step--locked' : '' }}"
                 style="--step-delay: {{ $index * 0.1 }}s;">

                <div class="lesson-step-number" style="background: {{ $isUnlocked ? $world->color . '22' : 'rgba(255,255,255,0.03)' }}; border-color: {{ $isUnlocked ? $world->color : 'rgba(255,255,255,0.1)' }};">
                    @if($isCompleted)
                        <span class="step-icon">✅</span>
                    @elseif(!$isUnlocked)
                        <span class="step-icon">🔒</span>
                    @else
                        <span class="step-icon">{{ $lesson->icon }}</span>
                    @endif
                    
                    <span class="step-badge-num">{{ $index + 1 }}</span>
                </div>

                @if($isUnlocked)
                    <a href="{{ route('game.lesson', $lesson->slug) }}" class="lesson-card-link">
                @else
                    <div class="lesson-card-link lesson-card--locked">
                @endif
                        <div class="lesson-card-body">
                            <div class="lesson-card-header">
                                <h3>{{ $lesson->title }}</h3>
                                @if($isCurrent)
                                    <span class="current-tag" style="background: {{ $world->color }};">En curso</span>
                                @endif
                            </div>
                            <p>{{ $lesson->description }}</p>
                        </div>

                        <div class="lesson-card-meta">
                            @if($isCompleted)
                                <div class="lesson-stars">
                                    @for($i = 1; $i <= 3; $i++)
                                        <span class="star {{ $i <= $data['stars'] ? 'star--filled' : '' }}">⭐</span>
                                    @endfor
                                </div>
                            @endif
                            <span class="lesson-xp-tag">+{{ $lesson->xp_reward }} XP</span>
                        </div>
                @if($isUnlocked)
                    </a>
                @else
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
