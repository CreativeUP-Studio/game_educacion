@extends('layouts.game')
@section('title', $lesson->title . ' - TrignoQuest')

@section('content')
<div class="lesson-page">
    <a href="{{ route('game.world', $lesson->world->slug) }}" class="world-back">← Volver a {{ $lesson->world->name }}</a>

    <div class="lesson-header">
        <span class="lesson-header-icon">{{ $lesson->icon }}</span>
        <h1>{{ $lesson->title }}</h1>
        <span class="lesson-world-tag">{{ $lesson->world->icon }} {{ $lesson->world->name }}</span>
    </div>

    <div class="content-blocks">
        @foreach($lesson->content as $block)
            @if($block['type'] === 'title')
                <div class="content-block block-title" style="animation-delay: {{ $loop->index * 0.08 }}s;">
                    <h2>{{ $block['text'] }}</h2>
                </div>
            @elseif($block['type'] === 'text')
                <div class="content-block block-text" style="animation-delay: {{ $loop->index * 0.08 }}s;">
                    {{ $block['text'] }}
                </div>
            @elseif($block['type'] === 'card')
                <div class="content-card" style="animation-delay: {{ $loop->index * 0.08 }}s;">
                    <div class="content-card-icon">{{ $block['icon'] }}</div>
                    <div>
                        <h3>{{ $block['title'] }}</h3>
                        <p>{{ $block['text'] }}</p>
                        @if(isset($block['example']))
                            <span class="example">{{ $block['example'] }}</span>
                        @endif
                    </div>
                </div>
            @elseif($block['type'] === 'tip')
                <div class="content-tip" style="animation-delay: {{ $loop->index * 0.08 }}s;">
                    {{ $block['text'] }}
                </div>
            @elseif($block['type'] === 'interactive')
                <div class="interactive-widget" id="widget-{{ $block['widget'] }}" data-widget="{{ $block['widget'] }}" style="animation-delay: {{ $loop->index * 0.08 }}s;">
                    <div class="widget-canvas-wrapper">
                        <canvas id="canvas-{{ $block['widget'] }}" width="500" height="400"></canvas>
                    </div>
                    <div class="widget-controls">
                        <div class="widget-slider-group">
                            <label>Ángulo:</label>
                            <input type="range" class="widget-slider" id="slider-{{ $block['widget'] }}" min="0" max="360" value="45">
                            <span class="widget-value" id="value-{{ $block['widget'] }}">45°</span>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="lesson-actions">
        <a href="{{ route('game.quiz', $lesson->slug) }}" class="btn btn-gold btn-lg">
            ⚔️ ¡Ir al Desafío!
        </a>
        <a href="{{ route('game.world', $lesson->world->slug) }}" class="btn btn-outline">
            ← Volver
        </a>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/widgets.js') }}"></script>
@endpush
@endsection
