<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $players = User::orderByDesc('xp')
            ->take(50)
            ->get()
            ->map(function ($user, $index) {
                return [
                    'rank' => $index + 1,
                    'name' => $user->name,
                    'level' => $user->level,
                    'xp' => $user->xp,
                    'avatar' => $user->avatar,
                    'title' => $user->level_title,
                    'stars' => $user->totalStars(),
                    'isCurrentUser' => auth()->check() && auth()->id() === $user->id,
                ];
            });

        return view('game.leaderboard', compact('players'));
    }
}
