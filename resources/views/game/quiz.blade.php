@extends('layouts.game')
@section('title', 'Quiz: ' . $lesson->title . ' - TrignoQuest')

@section('content')
<div class="quiz-page" id="quizApp">
    <div class="quiz-header">
        <h1>⚔️ Desafío: {{ $lesson->title }}</h1>
        <div class="quiz-progress-bar">
            <div class="quiz-progress-fill" id="quizProgressFill" style="width: 0%"></div>
        </div>
        <div class="quiz-stats">
            <span id="quizCounter">Pregunta 1 de {{ $questions->count() }}</span>
            <span id="quizStreak" class="quiz-streak">🔥 Racha: 0</span>
            <span id="quizXP">💎 XP: 0</span>
        </div>
    </div>

    <div id="questionContainer"></div>

    <div class="quiz-nav">
        <button class="btn btn-outline" id="btnPrev" disabled>← Anterior</button>
        <button class="btn btn-primary" id="btnNext">Siguiente →</button>
        <button class="btn btn-gold" id="btnSubmit" style="display:none;">🏆 Ver Resultados</button>
    </div>
</div>

<div class="results-overlay" id="resultsOverlay" style="display:none;">
    <div class="results-card" id="resultsCard">
        <div class="results-stars" id="resultsStars"></div>
        <div class="results-score" id="resultsScore"></div>
        <div class="results-text" id="resultsText"></div>
        <div class="results-details" id="resultsDetails"></div>
        <div class="results-buttons">
            <a href="{{ route('game.quiz', $lesson->slug) }}" class="btn btn-primary">🔄 Reintentar</a>
            <a href="{{ route('game.world', $lesson->world->slug) }}" class="btn btn-outline">← Volver al Mundo</a>
            <a href="{{ route('game.map') }}" class="btn btn-outline">🗺️ Mapa</a>
        </div>
    </div>
</div>

<div id="achievementsContainer"></div>
<div class="confetti-container" id="confettiContainer"></div>

@push('scripts')
<script>
const QUIZ_DATA = {
    lessonSlug: '{{ $lesson->slug }}',
    submitUrl: '{{ route("game.quiz.submit", $lesson->slug) }}',
    csrfToken: '{{ csrf_token() }}',
    questions: @json($questions)
};
</script>
<script src="{{ asset('js/quiz.js') }}"></script>
@endpush
@endsection
