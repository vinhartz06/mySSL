<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lineup extends Model
{
    use HasFactory;

    protected $fillable = ['match_id', 'player_id', 'role'];

    public function match(): BelongsTo {
        return $this->belongsTo(GameMatch::class);
    }

    public function player(): BelongsTo {
        return $this->belongsTo(Player::class);
    }

    public function scopeStarters($query) {
        return $query->where('role', 'start');
    }

    public function scopeSubstitutes($query) {
        return $query->where('role', 'sub');
    }
}