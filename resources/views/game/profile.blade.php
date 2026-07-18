@extends('layouts.game')
@section('title', 'Mi Perfil - TrignoQuest')

@section('content')
<div class="profile-page">
    @php
        $avatarMap = ['wizard'=>'🧙','warrior'=>'⚔️','archer'=>'🏹','mage'=>'🔮','knight'=>'🛡️','ninja'=>'🥷'];
    @endphp

    <div class="profile-header">
        <div class="profile-avatar">
            {{ $avatarMap[$user->avatar] ?? '🧙' }}
        </div>
        <div>
            <h1 class="profile-name">{{ $user->name }}</h1>
            <div class="profile-title">{{ $user->level_title }} — Nivel {{ $user->level }}</div>

            <div class="profile-stats">
                <div class="profile-stat">
                    <div class="profile-stat-value">{{ $user->xp }}</div>
                    <div class="profile-stat-label">XP Total</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-value">{{ $completedLessons }}</div>
                    <div class="profile-stat-label">Lecciones</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-value">{{ $totalStars }}</div>
                    <div class="profile-stat-label">⭐ Estrellas</div>
                </div>
                <div class="profile-stat">
                    <div class="profile-stat-value">{{ count($unlockedIds) }}</div>
                    <div class="profile-stat-label">Logros</div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-section">
        <h2>🎭 Cambiar Avatar</h2>
        <form action="{{ route('game.profile.avatar') }}" method="POST">
            @csrf
            <div class="avatar-selector">
                @foreach($avatarMap as $key => $emoji)
                    <button type="submit" name="avatar" value="{{ $key }}" 
                            class="avatar-option {{ $user->avatar === $key ? 'active' : '' }}"
                            title="{{ ucfirst($key) }}">
                        {{ $emoji }}
                    </button>
                @endforeach
            </div>
        </form>
    </div>

    <div class="profile-section">
        <h2>🏅 Logros ({{ count($unlockedIds) }}/{{ $allAchievements->count() }})</h2>
        <div class="achievements-grid">
            @foreach($allAchievements as $achievement)
                <div class="achievement-card {{ in_array($achievement->id, $unlockedIds) ? 'unlocked' : 'locked' }}">
                    <span class="achievement-icon">{{ $achievement->icon }}</span>
                    <div class="achievement-name">{{ $achievement->name }}</div>
                    <div class="achievement-desc">{{ $achievement->description }}</div>
                    @if(in_array($achievement->id, $unlockedIds))
                        <div style="margin-top:6px;font-size:0.75rem;color:var(--accent-gold);font-weight:800;">+{{ $achievement->xp_reward }} XP ✅</div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
