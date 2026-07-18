<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class World extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'color', 'bg_gradient', 'order', 'xp_required'];

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    public function isUnlockedFor($user): bool
    {
        if (!$user) return $this->xp_required === 0;
        return $user->xp >= $this->xp_required;
    }
}
