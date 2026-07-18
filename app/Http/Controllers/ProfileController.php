<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $user->load('achievements', 'progress.lesson.world');

        $completedLessons = $user->completedLessons()->count();
        $totalStars = $user->totalStars();
        $allAchievements = Achievement::all();
        $unlockedIds = $user->achievements->pluck('id')->toArray();

        return view('game.profile', compact('user', 'completedLessons', 'totalStars', 'allAchievements', 'unlockedIds'));
    }

    public function updateAvatar(Request $request)
    {
        $request->validate(['avatar' => 'required|string|in:wizard,warrior,archer,mage,knight,ninja']);
        auth()->user()->update(['avatar' => $request->avatar]);
        return back()->with('success', '¡Avatar actualizado!');
    }
}
