<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\WorldController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', [GameController::class, 'welcome'])->name('welcome');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Game routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/map', [GameController::class, 'map'])->name('game.map');
    Route::get('/world/{slug}', [WorldController::class, 'show'])->name('game.world');
    Route::get('/lesson/{slug}', [LessonController::class, 'show'])->name('game.lesson');
    Route::get('/quiz/{lessonSlug}', [QuizController::class, 'start'])->name('game.quiz');
    Route::post('/quiz/{lessonSlug}/submit', [QuizController::class, 'submit'])->name('game.quiz.submit');
    Route::get('/profile', [ProfileController::class, 'show'])->name('game.profile');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('game.profile.avatar');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('game.leaderboard');
});
