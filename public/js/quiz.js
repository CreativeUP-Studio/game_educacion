/**
 * TrignoQuest - Quiz Engine
 * Handles quiz navigation, scoring, streak tracking, and result submission.
 */
(function() {
    'use strict';

    const questions = QUIZ_DATA.questions;
    const totalQuestions = questions.length;

    let currentIndex = 0;
    let answers = {};
    let answered = {};
    let streak = 0;
    let maxStreak = 0;
    let xpEarned = 0;

    // DOM Elements
    const container = document.getElementById('questionContainer');
    const progressFill = document.getElementById('quizProgressFill');
    const counter = document.getElementById('quizCounter');
    const streakEl = document.getElementById('quizStreak');
    const xpEl = document.getElementById('quizXP');
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const btnSubmit = document.getElementById('btnSubmit');

    function renderQuestion(index) {
        const q = questions[index];
        const letters = ['A', 'B', 'C', 'D'];
        const diffLabel = { easy: 'Fácil', medium: 'Medio', hard: 'Difícil' };

        let optionsHtml = '';
        if (q.options) {
            q.options.forEach((opt, i) => {
                const isSelected = answers[q.id] === opt;
                const wasAnswered = answered[q.id];
                let cls = '';
                if (wasAnswered) {
                    if (opt === q.correct_answer) cls = 'correct';
                    else if (isSelected) cls = 'incorrect';
                } else if (isSelected) {
                    cls = 'selected';
                }

                optionsHtml += `
                    <button class="option-btn ${cls}" 
                            data-question-id="${q.id}" 
                            data-value="${opt}"
                            ${wasAnswered ? 'disabled' : ''}>
                        <span class="option-letter">${letters[i] || (i+1)}</span>
                        <span>${opt}</span>
                    </button>`;
            });
        }

        let explanationHtml = '';
        if (answered[q.id]) {
            explanationHtml = `
                <div class="explanation-box">
                    <strong>📖 Explicación:</strong> ${q.explanation}
                </div>`;
        }

        container.innerHTML = `
            <div class="question-card">
                <span class="question-badge ${q.difficulty}">${diffLabel[q.difficulty] || q.difficulty}</span>
                <span class="question-xp">+${q.xp_value} XP</span>
                <div class="question-text">${q.question}</div>
                <div class="options-grid">${optionsHtml}</div>
                ${explanationHtml}
            </div>`;

        // Bind option clicks
        container.querySelectorAll('.option-btn:not([disabled])').forEach(btn => {
            btn.addEventListener('click', () => selectOption(q.id, btn.dataset.value));
        });

        // Update UI
        progressFill.style.width = `${((index + 1) / totalQuestions) * 100}%`;
        counter.textContent = `Pregunta ${index + 1} de ${totalQuestions}`;
        btnPrev.disabled = index === 0;

        const allAnswered = questions.every(q => answered[q.id]);
        if (index === totalQuestions - 1) {
            btnNext.style.display = 'none';
            btnSubmit.style.display = allAnswered ? 'inline-flex' : 'none';
        } else {
            btnNext.style.display = 'inline-flex';
            btnSubmit.style.display = 'none';
        }
    }

    function selectOption(questionId, value) {
        const q = questions.find(q => q.id === questionId);
        if (answered[questionId]) return;

        answers[questionId] = value;
        answered[questionId] = true;

        const isCorrect = value === q.correct_answer;

        if (isCorrect) {
            streak++;
            if (streak > maxStreak) maxStreak = streak;
            xpEarned += q.xp_value;
        } else {
            streak = 0;
        }

        // Update streak display
        streakEl.textContent = `🔥 Racha: ${streak}`;
        streakEl.className = `quiz-streak ${streak >= 3 ? 'active' : ''}`;
        xpEl.textContent = `💎 XP: ${xpEarned}`;

        // Re-render to show correct/incorrect
        renderQuestion(currentIndex);

        // Auto-advance after a short delay
        if (currentIndex < totalQuestions - 1) {
            setTimeout(() => {
                currentIndex++;
                renderQuestion(currentIndex);
            }, 1500);
        } else {
            // Last question - show submit button
            const allAnswered = questions.every(q => answered[q.id]);
            if (allAnswered) {
                btnSubmit.style.display = 'inline-flex';
            }
        }
    }

    btnPrev.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            renderQuestion(currentIndex);
        }
    });

    btnNext.addEventListener('click', () => {
        if (currentIndex < totalQuestions - 1) {
            currentIndex++;
            renderQuestion(currentIndex);
        }
    });

    btnSubmit.addEventListener('click', submitQuiz);

    async function submitQuiz() {
        btnSubmit.disabled = true;
        btnSubmit.textContent = '⏳ Enviando...';

        try {
            const response = await fetch(QUIZ_DATA.submitUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': QUIZ_DATA.csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    answers: answers,
                    max_streak: maxStreak,
                }),
            });

            const data = await response.json();
            showResults(data);
        } catch (err) {
            console.error('Quiz submit error:', err);
            btnSubmit.disabled = false;
            btnSubmit.textContent = '🏆 Ver Resultados';
            alert('Error al enviar. Intenta de nuevo.');
        }
    }

    function showResults(data) {
        const summary = data.summary;
        const resultsOverlay = document.getElementById('resultsOverlay');
        const starsContainer = document.getElementById('resultsStars');
        const scoreEl = document.getElementById('resultsScore');
        const textEl = document.getElementById('resultsText');
        const detailsEl = document.getElementById('resultsDetails');

        // Stars
        let starsHtml = '';
        for (let i = 1; i <= 3; i++) {
            const earned = i <= summary.stars;
            starsHtml += `<span class="star ${earned ? 'earned' : 'empty'}" style="animation-delay: ${i * 0.3}s">⭐</span>`;
        }
        starsContainer.innerHTML = starsHtml;

        // Score
        let scoreClass = 'poor';
        if (summary.percentage >= 90) scoreClass = 'excellent';
        else if (summary.percentage >= 60) scoreClass = 'good';

        scoreEl.className = `results-score ${scoreClass}`;
        scoreEl.textContent = `${summary.percentage}%`;

        // Text
        let message = '¡Sigue practicando! No te rindas.';
        if (summary.percentage >= 90) message = '🎉 ¡INCREÍBLE! ¡Eres un genio!';
        else if (summary.percentage >= 70) message = '👏 ¡Muy bien! Casi perfecto.';
        else if (summary.percentage >= 60) message = '👍 ¡Bien hecho! Aprobaste.';
        textEl.textContent = message;

        // Details
        detailsEl.innerHTML = `
            <div class="results-detail">
                <div class="results-detail-value">${summary.correct}/${summary.total}</div>
                <div class="results-detail-label">Correctas</div>
            </div>
            <div class="results-detail">
                <div class="results-detail-value">+${summary.xp_earned}</div>
                <div class="results-detail-label">XP Ganados</div>
            </div>
            <div class="results-detail">
                <div class="results-detail-value">Nv.${summary.new_level}</div>
                <div class="results-detail-label">Tu Nivel</div>
            </div>`;

        resultsOverlay.style.display = 'flex';

        // Confetti for good scores
        if (summary.percentage >= 70) {
            launchConfetti();
        }

        // Show achievements
        if (data.achievements && data.achievements.length > 0) {
            data.achievements.forEach((ach, i) => {
                setTimeout(() => showAchievement(ach), 1000 + (i * 1500));
            });
        }
    }

    function showAchievement(achievement) {
        const container = document.getElementById('achievementsContainer');
        const popup = document.createElement('div');
        popup.className = 'achievement-popup';
        popup.innerHTML = `
            <div class="achievement-popup-header">🏅 ¡Logro Desbloqueado!</div>
            <div class="achievement-popup-content">
                <span class="achievement-popup-icon">${achievement.icon}</span>
                <div>
                    <div class="achievement-popup-name">${achievement.name}</div>
                    <div class="achievement-popup-desc">${achievement.description}</div>
                    <div class="achievement-popup-xp">+${achievement.xp_reward} XP</div>
                </div>
            </div>`;
        container.appendChild(popup);
        setTimeout(() => popup.remove(), 4000);
    }

    function launchConfetti() {
        const container = document.getElementById('confettiContainer');
        const colors = ['#6C63FF', '#00D4FF', '#FFD93D', '#00E676', '#FF6B9D', '#FFA502'];
        
        for (let i = 0; i < 60; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + '%';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDuration = (2 + Math.random() * 2) + 's';
            confetti.style.animationDelay = Math.random() * 1 + 's';
            confetti.style.width = (6 + Math.random() * 8) + 'px';
            confetti.style.height = (6 + Math.random() * 8) + 'px';
            confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '2px';
            container.appendChild(confetti);
        }

        setTimeout(() => { container.innerHTML = ''; }, 5000);
    }

    // Initialize
    renderQuestion(0);
})();
