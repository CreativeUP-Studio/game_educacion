<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show($slug)
    {
        $lesson = Lesson::where('slug', $slug)->with(['world', 'questions'])->firstOrFail();
        $user = auth()->user();
        $progress = $lesson->progressFor($user);

        return view('game.lesson', compact('lesson', 'user', 'progress'));
    }
}
