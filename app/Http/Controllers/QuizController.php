<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\UserProgress;
use App\Models\Achievement;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function start($lessonSlug)
    {
        $lesson = Lesson::where('slug', $lessonSlug)->with('questions')->firstOrFail();
        $questions = $lesson->questions->shuffle()->map(function($q) {
            return [
                'id' => $q->id,
                'type' => $q->type,
                'question' => $q->question,
                'options' => $q->options,
                'correct_answer' => $q->correct_answer,
                'explanation' => $q->explanation,
                'difficulty' => $q->difficulty,
                'xp_value' => $q->xp_value,
            ];
        });

        return view('game.quiz', compact('lesson', 'questions'));
    }

    public function submit(Request $request, $lessonSlug)
    {
        $lesson = Lesson::where('slug', $lessonSlug)->with('questions')->firstOrFail();
        $user = auth()->user();

        $answers = $request->input('answers', []);
        $totalQuestions = $lesson->questions->count();
        $correct = 0;
        $xpEarned = 0;
        $results = [];

        foreach ($lesson->questions as $question) {
            $userAnswer = $answers[$question->id] ?? null;
            $isCorrect = $userAnswer === $question->correct_answer;

            if ($isCorrect) {
                $correct++;
                $xpEarned += $question->xp_value;
            }

            $results[] = [
                'question_id' => $question->id,
                'question' => $question->question,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'explanation' => $question->explanation,
                'xp' => $isCorrect ? $question->xp_value : 0,
            ];
        }

        $percentage = $totalQuestions > 0 ? round(($correct / $totalQuestions) * 100) : 0;
        $stars = $this->calculateStars($percentage);

        // Add lesson completion bonus
        if ($percentage >= 60) {
            $xpEarned += $lesson->xp_reward;
        }

        // Update or create progress
        $progress = UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'lesson_id' => $lesson->id],
            [
                'score' => $percentage,
                'max_score' => max($percentage, UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->value('max_score') ?? 0),
                'stars' => max($stars, UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->value('stars') ?? 0),
                'attempts' => \DB::raw('attempts + 1'),
                'completed_at' => $percentage >= 60 ? now() : null,
            ]
        );

        // Update user XP and level
        $user->xp += $xpEarned;
        $while_leveling = true;
        while ($while_leveling) {
            $xpNeeded = $user->xpForNextLevel();
            if ($user->xp >= $xpNeeded) {
                $user->level++;
            } else {
                $while_leveling = false;
            }
        }
        $user->save();

        // Check achievements
        $newAchievements = $this->checkAchievements($user, $stars, $request->input('max_streak', 0));

        return response()->json([
            'success' => true,
            'results' => $results,
            'summary' => [
                'correct' => $correct,
                'total' => $totalQuestions,
                'percentage' => $percentage,
                'stars' => $stars,
                'xp_earned' => $xpEarned,
                'new_level' => $user->level,
                'total_xp' => $user->xp,
            ],
            'achievements' => $newAchievements,
        ]);
    }

    private function calculateStars(int $percentage): int
    {
        if ($percentage >= 90) return 3;
        if ($percentage >= 70) return 2;
        if ($percentage >= 60) return 1;
        return 0;
    }

    private function checkAchievements($user, $stars, $maxStreak): array
    {
        $newAchievements = [];
        $achievements = Achievement::all();
        $completedCount = $user->completedLessons()->count();

        foreach ($achievements as $achievement) {
            if ($user->achievements()->where('achievement_id', $achievement->id)->exists()) {
                continue;
            }

            $unlocked = false;
            switch ($achievement->condition_type) {
                case 'lessons_completed':
                    $unlocked = $completedCount >= $achievement->condition_value;
                    break;
                case 'perfect_score':
                    $unlocked = $stars >= 3;
                    break;
                case 'streak':
                    $unlocked = $maxStreak >= $achievement->condition_value;
                    break;
                case 'level_reached':
                    $unlocked = $user->level >= $achievement->condition_value;
                    break;
                case 'worlds_completed':
                    $worldsCompleted = \App\Models\World::all()->filter(function ($world) use ($user) {
                        $lessons = $world->lessons;
                        if ($lessons->isEmpty()) return false;
                        return $lessons->every(fn($l) => $l->isCompletedBy($user));
                    })->count();
                    $unlocked = $worldsCompleted >= $achievement->condition_value;
                    break;
            }

            if ($unlocked) {
                $user->achievements()->attach($achievement->id, ['unlocked_at' => now()]);
                $user->xp += $achievement->xp_reward;
                $user->save();
                $newAchievements[] = [
                    'name' => $achievement->name,
                    'description' => $achievement->description,
                    'icon' => $achievement->icon,
                    'xp_reward' => $achievement->xp_reward,
                ];
            }
        }

        return $newAchievements;
    }
}
