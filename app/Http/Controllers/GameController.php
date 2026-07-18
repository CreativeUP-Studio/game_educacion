<?php

namespace App\Http\Controllers;

use App\Models\World;
use App\Models\Achievement;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function map()
    {
        $worlds = World::with(['lessons'])->orderBy('order')->get();
        $user = auth()->user();

        $worldsData = $worlds->map(function ($world) use ($user) {
            $totalLessons = $world->lessons->count();
            $completedLessons = 0;
            $totalStars = 0;

            if ($user) {
                foreach ($world->lessons as $lesson) {
                    $progress = $lesson->progressFor($user);
                    if ($progress && $progress->completed_at) {
                        $completedLessons++;
                        $totalStars += $progress->stars;
                    }
                }
            }

            return [
                'world' => $world,
                'totalLessons' => $totalLessons,
                'completedLessons' => $completedLessons,
                'totalStars' => $totalStars,
                'maxStars' => $totalLessons * 3,
                'unlocked' => $world->isUnlockedFor($user),
                'progress' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0,
            ];
        });

        return view('game.map', compact('worldsData', 'user'));
    }

    public function laboratory()
    {
        return view('game.laboratory');
    }
}
