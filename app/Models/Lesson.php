<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = ['world_id', 'title', 'slug', 'description', 'content', 'order', 'xp_reward', 'icon'];

    protected $casts = [
        'content' => 'array',
    ];

    public function world(): BelongsTo
    {
        return $this->belongsTo(World::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }

    public function progressFor($user)
    {
        if (!$user) return null;
        return $this->userProgress()->where('user_id', $user->id)->first();
    }

    public function isCompletedBy($user): bool
    {
        $progress = $this->progressFor($user);
        return $progress && $progress->completed_at !== null;
    }
}
