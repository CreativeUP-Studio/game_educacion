<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'level', 'xp', 'streak', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function progress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'user_achievements')->withPivot('unlocked_at');
    }

    public function completedLessons()
    {
        return $this->progress()->whereNotNull('completed_at');
    }

    public function totalStars(): int
    {
        return $this->progress()->sum('stars');
    }

    public function getLevelTitleAttribute(): string
    {
        $titles = [
            1 => 'Aprendiz',
            2 => 'Explorador',
            3 => 'Aventurero',
            4 => 'Guerrero',
            5 => 'Maestro',
            6 => 'Sabio',
            7 => 'Leyenda',
        ];
        $level = min($this->level, 7);
        return $titles[$level] ?? 'Aprendiz';
    }

    public function xpForNextLevel(): int
    {
        return $this->level * 200;
    }

    public function xpProgress(): int
    {
        $needed = $this->xpForNextLevel();
        $currentLevelXp = ($this->level - 1) * 200;
        $progress = $this->xp - $currentLevelXp;
        return $needed > 0 ? min(100, (int)(($progress / 200) * 100)) : 100;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
