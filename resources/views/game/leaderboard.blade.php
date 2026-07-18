@extends('layouts.game')
@section('title', 'Ranking - TrignoQuest')

@section('content')
<div class="leaderboard-page">
    <div class="leaderboard-header">
        <h1>🏆 Tabla de <span style="background: var(--gradient-gold); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Clasificación</span></h1>
        <p style="color:var(--text-secondary);">Los mejores aventureros trigonométricos</p>
    </div>

    @php
        $avatarMap = ['wizard'=>'🧙','warrior'=>'⚔️','archer'=>'🏹','mage'=>'🔮','knight'=>'🛡️','ninja'=>'🥷'];
    @endphp

    @if($players->count() >= 3)
    <div class="leaderboard-podium">
        @foreach($players->take(3) as $i => $player)
            @php
                $classes = ['first', 'second', 'third'];
                $ranks = ['🥇', '🥈', '🥉'];
                $rankColors = ['gold', 'silver', 'bronze'];
            @endphp
            <div class="podium-item {{ $classes[$i] }}">
                <div class="podium-rank {{ $rankColors[$i] }}">{{ $ranks[$i] }}</div>
                <div class="podium-avatar">
                    {{ $avatarMap[$player['avatar']] ?? '🧙' }}
                </div>
                <div class="podium-name">{{ $player['name'] }}</div>
                <div class="podium-xp">{{ number_format($player['xp']) }} XP • Nv.{{ $player['level'] }}</div>
            </div>
        @endforeach
    </div>
    @endif

    <div class="leaderboard-list">
        @foreach($players->skip(3) as $player)
            <div class="leaderboard-row {{ $player['isCurrentUser'] ? 'current-user' : '' }}">
                <div class="lb-rank">#{{ $player['rank'] }}</div>
                <div class="lb-player">
                    <div class="lb-avatar">{{ $avatarMap[$player['avatar']] ?? '🧙' }}</div>
                    <div>
                        <div class="lb-name">{{ $player['name'] }} {{ $player['isCurrentUser'] ? '(Tú)' : '' }}</div>
                        <div class="lb-title">{{ $player['title'] }} • Nv.{{ $player['level'] }}</div>
                    </div>
                </div>
                <div class="lb-xp">{{ number_format($player['xp']) }} XP</div>
            </div>
        @endforeach

        @if($players->isEmpty())
            <div style="text-align:center;padding:40px;color:var(--text-muted);">
                <div style="font-size:3rem;margin-bottom:12px;">🏜️</div>
                <p>¡Aún no hay jugadores! Sé el primero en aparecer aquí.</p>
            </div>
        @endif
    </div>
</div>
@endsection
