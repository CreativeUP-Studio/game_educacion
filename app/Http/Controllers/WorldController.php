<?php

namespace App\Http\Controllers;

use App\Models\World;
use App\Models\Lesson;
use Illuminate\Http\Request;

class WorldController extends Controller
{
    public function show($slug)
    {
        $world = World::where('slug', $slug)->with(['lessons'])->firstOrFail();
        $user = auth()->user();

        if (!$world->isUnlockedFor($user)) {
            return redirect()->route('game.map')->with('error', '¡Necesitas más XP para desbloquear este mundo!');
        }

        $lessonsData = $world->lessons->map(function ($lesson, $index) use ($user, $world) {
            $progress = $lesson->progressFor($user);
            $isCompleted = $progress && $progress->completed_at;

            // First lesson always unlocked, rest require previous completion
            $previousCompleted = $index === 0;
            if ($index > 0) {
                $prevLesson = $world->lessons[$index - 1];
                $prevProgress = $prevLesson->progressFor($user);
                $previousCompleted = $prevProgress && $prevProgress->completed_at;
            }

            return [
                'lesson' => $lesson,
                'progress' => $progress,
                'isCompleted' => $isCompleted,
                'isUnlocked' => $previousCompleted || $isCompleted,
                'stars' => $progress ? $progress->stars : 0,
            ];
        });

        return view('game.world', compact('world', 'lessonsData', 'user'));
    }
}
