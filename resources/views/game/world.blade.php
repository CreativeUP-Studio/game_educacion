@extends('layouts.game')
@section('title', $world->name . ' - TrignoQuest')

@section('content')
<div class="world-page">
    <a href="{{ route('game.map') }}" class="world-back">← Volver al mapa</a>

    <div class="world-header" style="background: {{ $world->bg_gradient }}22; border: 1px solid {{ $world->color }}33; border-radius: var(--border-radius-lg);">
        <span class="world-header-icon">{{ $world->icon }}</span>
        <h1 style="color: {{ $world->color }};">{{ $world->name }}</h1>
        <p>{{ $world->description }}</p>
    </div>

    <div class="lessons-list">
        @foreach($lessonsData as $index => $data)
            @php $lesson = $data['lesson']; @endphp
            @if($data['isUnlocked'])
                <a href="{{ route('game.lesson', $lesson->slug) }}" 
                   class="lesson-card {{ $data['isCompleted'] ? 'completed' : '' }}"
                   style="animation-delay: {{ $index * 0.1 }}s;">
            @else
                <div class="lesson-card locked" style="animation-delay: {{ $index * 0.1 }}s;">
            @endif
                    <div class="lesson-number">
                        @if($data['isCompleted'])
                            ✅
                        @elseif(!$data['isUnlocked'])
                            🔒
                        @else
                            {{ $lesson->icon }}
                        @endif
                    </div>

                    <div class="lesson-info">
                        <h3>{{ $lesson->title }}</h3>
                        <p>{{ $lesson->description }}</p>
                    </div>

                    <div class="lesson-status">
                        @if($data['isCompleted'])
                            <div class="lesson-stars">
                                @for($i = 1; $i <= 3; $i++)
                                    {{ $i <= $data['stars'] ? '⭐' : '☆' }}
                                @endfor
                            </div>
                        @endif
                        <span class="lesson-xp">+{{ $lesson->xp_reward }} XP</span>
                    </div>

            @if($data['isUnlocked'])
                </a>
            @else
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
